<?php
/**
* 生徒用画面トップページのコントローラ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\HomeGetResponder as Responder;
use App\Services\SettingServiceInterface;
use App\Services\ScheduleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class HomeGetAction extends Controller
{
    protected $Responder;
    /**
     * @var SettingServiceInterface
     */
    private $settingService;
    /**
     * @var ScheduleServiceInterface
     */
    private $scheduleService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param SettingServiceInterface
     * @param ScheduleServiceInterface
     */

    public function __construct(

        Responder $Responder,
        SettingServiceInterface $settingService,
        ScheduleServiceInterface $scheduleService

    )
    {
        $this->Responder = $Responder;
        $this->settingService = $settingService;
        $this->scheduleService = $scheduleService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        // ユーザー情報取得
        $user = Auth::user();

        // お知らせ情報の取得
        $notice = $this->settingService->getSettingInformation();

        // ホーム画面表示の日時ごとの切り替え
        $carbon = Carbon::now();
        $dt_from = $carbon->copy()->startOfDay();
        $dt_to = $carbon->copy()->endOfDay();

        // スケジュールの取得
        // $schedules = Auth::user()->schedule()->whereBetween('created_at', [$dt_from, $dt_to])->get();
        $schedule = $this->scheduleService->getSchedulesPerDay($user, $dt_from, $dt_to);

        // スケジュールの時間表記を日本時間に調整
        foreach($user as $users) {
            $current_time = new Carbon('Asia/Tokyo');
            $schedule_time = new Carbon($users['test_date']);
            $count = $current_time->diff($schedule_time)->days;
        }

        return $this->Responder->response([
            'users' => $user,
            'notices' => $notice,
            'schedules' => $schedule,
            'count' => $count,
        ]);
    }
}
