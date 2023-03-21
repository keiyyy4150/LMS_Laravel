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
use App\Services\NotificationMessagesServiceInterface;
use Illuminate\Http\Response;
use Carbon\Carbon;

class HomeGetController extends Controller
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
     * @var NotificationMessagesServiceInterface
     */
    private $notificationMessagesService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param SettingServiceInterface
     * @param ScheduleServiceInterface
     * @param NotificationMessagesServiceInterface
     */

    public function __construct(

        Responder $Responder,
        SettingServiceInterface $settingService,
        ScheduleServiceInterface $scheduleService,
        NotificationMessagesServiceInterface $notificationMessagesService

    )
    {
        $this->Responder = $Responder;
        $this->settingService = $settingService;
        $this->scheduleService = $scheduleService;
        $this->notificationMessagesService = $notificationMessagesService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {
        // ユーザー情報取得
        $user = Auth::user();

        // お知らせメッセージの取得
        $notification_messages = $this->notificationMessagesService->getNotificationsByUseID($user['id']);
        $unread_messages = $this->notificationMessagesService->getUnreadNotifications($user['id']);
        $number_of_unread_messages = count($unread_messages);

        // お知らせ情報（バナー）の取得
        $notice = $this->settingService->getSettingInformation();

        // ホーム画面表示の日時ごとの切り替え
        $carbon = Carbon::now();
        $dt_from = $carbon->copy()->startOfDay();
        $dt_to = $carbon->copy()->endOfDay();

        // スケジュールの取得
        $schedule = $this->scheduleService->getSchedulesPerDay($user, $dt_from, $dt_to);

        // スケジュールの時間表記を日本時間に調整
        $current_time = new Carbon('Asia/Tokyo');
        $schedule_time = new Carbon($user['test_date']);
        $count = $current_time->diff($schedule_time)->days;

        // 受験日が現在時間よりも前
        if ($schedule_time < $current_time || $schedule_time == null) {
            $count = '--';
        }

        // タイマーフラグ設定
        $flg_key = ['start', 'stop'];
        $flg_val = [0, 1];
        $timer_flg = array_combine($flg_key, $flg_val);

        return $this->Responder->response([
            'users' => $user,
            'notification_messages' => $notification_messages,
            'unread_messages' => $unread_messages,
            'number_of_unread_messages' => $number_of_unread_messages,
            'notices' => $notice,
            'schedules' => $schedule,
            'count' => $count,
            'timer_flg' => $timer_flg,
        ]);
    }
}
