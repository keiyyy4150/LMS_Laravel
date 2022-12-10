<?php

namespace App\Services;

use App\Models\AccountBasicInformation;
use App\Models\AccountDetailInformation;
use App\Models\ChangeScheduleAccount;
use App\Notifications\Account\PasswordRemind;
use App\Notifications\Account\SelfConfirm;
use App\Repositories\AccountBasicInformationRepositoryInterface;
use App\Repositories\AccountDetailInformationRepositoryInterface;
use App\Repositories\ChangeScheduleAccountRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\PasswordSettingRepositoryInterface;
use App\Repositories\RoleAuthorityRepositoryInterface;
use App\Repositories\SignonRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountService implements AccountServiceInterface
{
    /**
     * @var AccountBasicInformationRepositoryInterface
     */
    protected $accountBasicInformationRepository;
    /**
     * @var DepartmentRepositoryInterface
     */
    protected $departmentRepository;
    /**
     * @var PasswordSettingRepositoryInterface
     */
    public function __construct(
        AccountBasicInformationRepositoryInterface $accountBasicInformationRepository,
        DepartmentRepositoryInterface $departmentRepository,
        PasswordSettingRepositoryInterface $passwordSettingRepository,
        AccountDetailInformationRepositoryInterface $accountDetailInformationRepository,
        ChangeScheduleAccountRepositoryInterface $changeScheduleAccountRepository,
        RoleAuthorityRepositoryInterface $roleAuthorityRepository,
        SignonRepositoryInterface $signonRepository
    ) {
        $this->accountBasicInformationRepository = $accountBasicInformationRepository;
        $this->departmentRepository = $departmentRepository;
        $this->passwordSettingRepository = $passwordSettingRepository;
        $this->accountDetailInformationRepository = $accountDetailInformationRepository;
        $this->changeScheduleAccountRepository = $changeScheduleAccountRepository;
        $this->roleAuthorityRepository = $roleAuthorityRepository;
        $this->signonRepository = $signonRepository;
    }

    public static function getUser()
    {
        $user = Auth::user();
        if ($user === null) {
            return null;
        }

        $detail = Session::get(config('auth.session.detail'));
        if ($detail !== null) {
            $detail = collect(json_decode($detail, true));
            $user->detail_id = $detail->pull('id');
            foreach ($detail as $key => $value) {
                $user->$key = $value;
            }
        }
        $user->detail_list = static::getUserDetailList();

        $hidden = ['password', 'password_expiration_date', 'remember_token'];
        foreach ($hidden as $key) {
            unset($user->$key);
        }

        return $user;
    }

    public static function getUserDetailList()
    {
        return json_decode(Session::get(config('auth.session.detail_list')), true);
    }

    public static function getUserCrud()
    {
        return collect(json_decode(Session::get(config('auth.session.crud')), true));
    }

    public function register(array $data): ?AccountBasicInformation
    {
        $account = $this->accountBasicInformationRepository->save($data);
        $this->sendSelfConfirmMail($account);
        return $account;
    }

    public function login(string $account_id, string $password, string $company_division): bool
    {
        $account = $this->accountBasicInformationRepository->findByAccountId($account_id, $company_division);
        $checked = $this->accountBasicInformationRepository->loginCheck($account, $password);
        if (!$checked) {
            return false;
        }

        $detail = $this->accountDetailInformationRepository->getRecentLoggedAuthDetail($account);
        if ($detail === null) {
            return false;
        }

        $detail_list = $this->accountDetailInformationRepository->getDetailList($account);
        $authorities = $this->roleAuthorityRepository->getByDepartmentMasterId($detail->department_master_id);

        Auth::loginUsingId($account->id);
        Session::put(config('auth.session.detail'), $detail->toJson());
        Session::put(config('auth.session.detail_list'), $detail_list->toJson());
        Session::put(config('auth.session.crud'), $authorities->toJson());
        $this->accountDetailInformationRepository->updateLoginTime($detail);

        // サインオンテーブル保存
        $this->signonRepository->save($detail->id);

        // 強制サインアウト再ログイン
        if ($account->force_logout == 1) {
            $accountBasicInformation = $this->accountBasicInformationRepository->find($account->id);
            $data['force_logout'] = null;
            $this->accountBasicInformationRepository->save($data, $accountBasicInformation);
        }

        return true;
    }

    public function logout(?AccountBasicInformation $account = null): void
    {
        if ($account === null) {
            Auth::logout();
        }
    }

    public function changeLoginDepartment($detail_id): bool
    {
        $user = self::getUser();
        if ($user === null) {
            return false;
        }

        $detail = $this->accountDetailInformationRepository->getAuthDetail($detail_id, $user->id);
        if ($detail === null) {
            return false;
        }

        $authorities = $this->roleAuthorityRepository->getByDepartmentMasterId($detail->department_master_id);

        Session::put(config('auth.session.detail'), $detail->toJson());
        Session::put(config('auth.session.crud'), $authorities->toJson());
        $this->accountDetailInformationRepository->updateLoginTime($detail);

        return true;
    }

    public function sendSelfConfirmMail(AccountBasicInformation $account): bool
    {
        $token = $this->passwordSettingRepository->generateSelfConfirmToken($account);
        $account->notify(new SelfConfirm($token));
        return true;
    }

    /**
     * @param string $token
     * @return AccountBasicInformation|null
     */
    public function selfConfirm(string $token): ?AccountBasicInformation
    {
        $account = $this->passwordSettingRepository->checkToken($token);
        if ($account) {
            $this->accountBasicInformationRepository->selfConfirm($account);
            return $account;
        }
        return null;
    }

    /**
     * @param AccountBasicInformation $account
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(AccountBasicInformation $account, string $newPassword): bool
    {
        return $this->passwordSettingRepository->changePassword($account, $newPassword);
    }

    public function getAccountBasics(array $search = [], ?int $per_page = null)
    {
        return $this->accountBasicInformationRepository->search($search, $per_page);
    }

    public function getAccountDetails(array $search, int $per_page)
    {
        return $this->accountDetailInformationRepository->search($search, $per_page);
    }

    public function save(array $data, ?AccountBasicInformation $accountBasicInformation = null): ?AccountBasicInformation
    {
        $account = DB::transaction(function () use ($data, $accountBasicInformation) {
            $account = $this->accountBasicInformationRepository->save($data, $accountBasicInformation);
            // 詳細
            foreach ($data['detail'] as $detail) {
                $detail['account_basic_information_id'] = $account->id;
                if (isset($detail['account_expiration_date']) && is_string($detail['account_expiration_date'])) {
                    try {
                        $detail['account_expiration_date'] = Carbon::createFromFormat(config('const.format.date'), $detail['account_expiration_date'])->setTime(0, 0, 0);
                    } catch (Exception $e) {
                    }
                }
                if (isset($detail['id']) && $detail['id'] !== null) {
                    if (isset($detail['schedule']) && $detail['schedule']) {
                        $change_schedule = $this->changeScheduleAccountRepository->findByAccountId((int)$detail['id'], $account->id);
                        $this->changeScheduleAccountRepository->save($detail, $change_schedule);
                    } else {
                        $accountDetailInformation = $this->accountDetailInformationRepository->findByAccountId((int)$detail['id'], $account->id);
                        $this->accountDetailInformationRepository->save($detail, $accountDetailInformation);
                    }
                } else {
                    $this->accountDetailInformationRepository->save($detail);
                }
            }
            // 変更予定
            if (isset($data['schedule'])) {
                foreach ($data['schedule'] as $schedule) {
                    if (isset($schedule['change_schedule_date']) && is_string($schedule['change_schedule_date'])) {
                        try {
                            $schedule['change_schedule_date'] = Carbon::createFromFormat(config('const.format.date'), $schedule['change_schedule_date'])->setTime(0, 0, 0);
                        } catch (Exception $e) {
                        }
                    }
                    $schedule['account_basic_information_id'] = $account->id;
                    $this->changeScheduleAccountRepository->save($schedule);
                }
            }

            return $account;
        });

        return $account;
    }

    /**
     * @param array $data
     * @return AccountBasicInformation
     * @throws \Throwable
     */
    public function create(array $data): AccountBasicInformation
    {
        return DB::transaction(function () use ($data): AccountBasicInformation {
            $detailList = $data['detail'];
            unset($data['detail']);
            // TODO
            $data['password'] = Hash::make('123456');
            $data['password_expiration_date'] = AccountBasicInformation::PASSWORD_EXPIRE_DAYS;
            $data['login_failed_count'] = 0;
            $data['status'] = AccountBasicInformation::STATUS_NOT_SELF_CONFIRMED;
            $accountBasic = $this->accountBasicInformationRepository->create($data);

            foreach ($detailList as $detail) {
                $detail['account_basic_information_id'] = $accountBasic->id;
                $detail['status'] = AccountDetailInformation::STATUS_TENTATIVE;
                $this->accountDetailInformationRepository->create($detail);
            }
            return $accountBasic;
        });
    }

    /**
     * @param string $accountId
     * @return AccountBasicInformation|null
     */
    public function findByAccountId(string $accountId): ?AccountBasicInformation
    {
        return $this->accountBasicInformationRepository->findByAccountId($accountId);
    }

    /**
     * @param AccountBasicInformation $account
     * @return AccountDetailInformation[]|ChangeScheduleAccount[]|Collection
     */
    public function getActiveDetails(AccountBasicInformation $account)
    {
        $details = $this->getCurrentActiveDetails($account);
        $change_schedules = $this->getActiveChangeScheduleList($account);

        foreach ($change_schedules as $change_schedule) {
            $details->push($change_schedule);
        }

        return $details;
    }

    public function getDeactivatedDetails(AccountBasicInformation $account)
    {
        return $account->accountDetailInformation()
            ->where('status', AccountDetailInformation::STATUS_DEACTIVATED)
            ->orderBy('created_at')
            ->get();
    }

    public function getCurrentActiveDetails(AccountBasicInformation $account)
    {
        return $this->accountDetailInformationRepository->getCurrentActiveDetailList($account);
    }

    public function getActiveChangeScheduleList(AccountBasicInformation $account)
    {
        return $account->changeScheduleAccount()
            ->where('status', ChangeScheduleAccount::STATUS_ACTIVE)
            ->where('processed_flag', ChangeScheduleAccount::PROCESSING)
            ->get();
    }

    /**
     * @param string $accountId
     * @param string|null $companyDivision
     * @return bool
     */
    public function sendPasswordReminderAccountId(string $accountId, ?string $companyDivision = null): bool
    {
        $account = $this->accountBasicInformationRepository->findByAccountId($accountId, $companyDivision);

        if ($account === null) {
            $account = $this->accountBasicInformationRepository->findByEmail($accountId, $companyDivision);
        }

        if ($account === null) {
            return false;
        }

        $token = $this->passwordSettingRepository->generatePasswordReminderToken($account);
        $account->notify(new PasswordRemind($token));
        return true;
    }

    /**
     * @param string $mailAddress
     * @return AccountBasicInformation|null
     */
    public function findByEmail(string $mailAddress): ?AccountBasicInformation
    {
        return $this->accountBasicInformationRepository->findByEmail($mailAddress);
    }

    public function setNewPasswordByPasswordReminder(string $token, string $new_password): bool
    {
        return $this->passwordSettingRepository->passwordRemindSetting();
    }

    /**
     * @param AccountBasicInformation $account
     * @param string $password
     * @return bool
     */
    public function setPassword(AccountBasicInformation $account, string $password): bool
    {
        return $this->passwordSettingRepository->setPassword($account, $password);
    }

    public function getCurrentDetail(string $id)
    {
        $account = $this->accountBasicInformationRepository->find($id);

        if (Session::has("current_account_detail")) {
            return Session::get("current_account_detail");
        } else {
            foreach ($account->accountDetailInformation as $accountDetail) {
                $this->setCurrentDetail($accountDetail);
                return $accountDetail;
            }
        }

        return null;
    }

    public function setCurrentDetail(string $id, AccountDetailInformation $account_detail)
    {
        $account = $this->accountBasicInformationRepository->find($id);
        Session::forget("current_account_detail");
        Session::put("current_account_detail", $account_detail);
    }

    /**
     * @param string $token
     * @return AccountBasicInformation|null
     */
    public function checkPasswordReminder(string $token): ?AccountBasicInformation
    {
        return $this->passwordSettingRepository->checkPasswordReminderToken($token);
    }

    public function getChangeScheduleAccounts(array $search = [], int $per_page = 15)
    {
        return $this->changeScheduleAccountRepository->search($search, $per_page);
    }

    public function find(int $id): ?AccountBasicInformation
    {
        return $this->accountBasicInformationRepository->find($id);
    }

    public function findDetail(int $id): ?AccountDetailInformation
    {
        return $this->accountDetailInformationRepository->find($id);
    }

    //強制サイアウト
    public function forceLogoutByID(int $id): bool
    {
        $accountBasicInformation = $this->accountBasicInformationRepository->find($id);
        $data['force_logout'] = 1;
        $this->accountBasicInformationRepository->save($data, $accountBasicInformation);
//        $user = Auth::user();
//        $userToLogout = AccountBasicInformation::find($id);
//        Auth::setUser($userToLogout);
//        DD(Auth::user());
//        Auth::logoutOtherDevices($userToLogout->password);
//        Auth::logout();
//        session::flush();
//        Session::getHandler()->destroy($userToLogout->session_id);
//        Auth::loginUsingId($user->id);
//        session::invalidate();
//        session::regenerateToken();
        return true;
    }

    public function getCurrentDepartment(AccountBasicInformation $account)
    {
        return $this->accountDetailInformationRepository->getNowDepartment($account);
    }

    public function getNowDepartment(AccountBasicInformation $account)
    {
        return $account->changeScheduleAccount()
            ->where('status', ChangeScheduleAccount::STATUS_ACTIVE)
            ->where('processed_flag', ChangeScheduleAccount::PROCESSING)
            ->where('affiliation_dept_flag', 1)
            ->get();
    }

    public function getNowDepartmentDetail(AccountBasicInformation $account)
    {
        $detail = $this->getCurrentDepartment($account);
        $change_schedules = $this->getNowDepartment($account);

        foreach ($change_schedules as $change_schedule) {
            $detail->push($change_schedule);
        }

        return $detail;
    }

    public function getChangeDepartment(AccountBasicInformation $account)
    {
        return $this->accountDetailInformationRepository->getChangeDepartment($account);
    }

    public function getChangeScheduleChangeDepartment(AccountBasicInformation $account)
    {
        return $account->changeScheduleAccount()
            ->where('status', ChangeScheduleAccount::STATUS_ACTIVE)
            ->where('processed_flag', ChangeScheduleAccount::PROCESSING)
            ->where('destination_dept_flag', 1)
            ->get();
    }

    public function getChangeDepartmentDetail(AccountBasicInformation $account)
    {
        $detail = $this->getChangeDepartment($account);
        $change_schedules = $this->getChangeScheduleChangeDepartment($account);

        foreach ($change_schedules as $change_schedule) {
            $detail->push($change_schedule);
        }

        return $detail;
    }

    public function getAccountsByDeptId(int $dept)
    {
        return $this->accountDetailInformationRepository->getAccountsByDeptId($dept);
    }

    /**
     * アカウント詳細読み取り
     * @param int|string|array $id_list
     */
    public function getAccountDetailList($id_list)
    {
        // アカウント詳細番号
        return $this->accountDetailInformationRepository->list($id_list);
    }

    /**
     * 変更予定アカウント読み取り
     * @param int|string|array $id_list
     */
    public function getChangeScheduleAccountList($id_list)
    {
        // 変更予定ID
        return $this->changeScheduleAccountRepository->list($id_list);
    }

    /**
     * 基本情報のみのsave
     * @param array $data
     * @param AccountBasicInformation|null $accountBasicInformation
     * @return AccountBasicInformation|null
     */
    public function saveBasic(array $data, ?AccountBasicInformation $accountBasicInformation = null): ?AccountBasicInformation
    {
        return $this->accountBasicInformationRepository->save($data, $accountBasicInformation);
    }

    /**
     * 詳細情報のみのsave
     * @param array $data
     * @param AccountDetailInformation|null $accountDetailInformation
     * @return AccountDetailInformation|null
     */
    public function saveDetail(array $data, ?AccountDetailInformation $accountDetailInformation = null): ?AccountDetailInformation
    {
        return $this->accountDetailInformationRepository->save($data, $accountDetailInformation);
    }

    /**
     * 詳細情報の検索
     * @param int $id アカウント詳細のid
     * @param int $account_id アカウントid(アカウント基本のid)
     * @return AccountDetailInformation|null
     */
    public function findDetailByAccountId(int $id, int $account_id): ?AccountDetailInformation
    {
        return $this->accountDetailInformationRepository->findByAccountId($id, $account_id);
    }

    /**
     * 変更予定アカウント情報の検索
     * @param int $id 変更予定アカウントのid
     * @param int $account_id アカウントid(アカウント基本のid)
     * @return ChangeScheduleAccount|null
     */
    public function findChangeByAccountId(int $id, int $account_id): ?ChangeScheduleAccount
    {
        return $this->changeScheduleAccountRepository->findByAccountId($id, $account_id);
    }

    /**
     * 変更予定アカウントのみのsave
     * @param array $data
     * @param ChangeScheduleAccount|null $accountChangeInformation
     * @return ChangeScheduleAccount|null
     */
    public function saveChange(array $data, ?ChangeScheduleAccount $accountChangeInformation = null): ?ChangeScheduleAccount
    {
        return $this->changeScheduleAccountRepository->save($data, $accountChangeInformation);
    }

    /**
     * 部署、課、職制、ステータスを元に、アカウント詳細情報の有無をチェックする。
     * @param string $department_master_id 部署コード
     * @param string $division_code 課コード
     * @param string $organization_code 職制コード
     * @param string $status ステータス
     * @return true|null アカウント詳細情報を返す。存在しない場合nullを返す。
     */
    public function getDetailInformation($department_master_id, $division_code, $organization_code, $status)
    {
        return $this->accountDetailInformationRepository->getDetailInformation($department_master_id, $division_code, $organization_code, $status);
    }

    /**
     * パラメータを元に、変更予定アカウント情報を取得する。
     * @param string $account_id アカウントID。
     * @param string $change_schedule_id アカウント詳細ID。
     * @return array|string|null 変更予定アカウント情報を返す。存在しない場合nullを返す。
     */
    public function getChangeScheduleAccount($account_id, string $change_schedule_id): ?ChangeScheduleAccount
    {
        return $this->changeScheduleAccountRepository->getChangeScheduleAccount($account_id, $change_schedule_id);
    }
}
