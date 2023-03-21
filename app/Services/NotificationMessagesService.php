<?php
/**
 * サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\NotificationMessagesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class NotificationMessagesService implements NotificationMessagesServiceInterface
{
    protected $notificationMessagesRepository;

    public function __construct(
        NotificationMessagesRepositoryInterface $notificationMessagesRepository
    ) {
        $this->notificationMessagesRepository = $notificationMessagesRepository;
    }

    // ログインユーザーのお知らせ取得
    public function getNotificationsByUseID($user_id)
    {
        return $this->notificationMessagesRepository->getNotificationsByUseID($user_id);
    }
    // お知らせ詳細を１件取得
    public function getNotificationDetailByID($id)
    {
        return $this->notificationMessagesRepository->getNotificationDetailByID($id);
    }
    // 未読メッセージの取得
    public function getUnreadNotifications($user_id)
    {
        return $this->notificationMessagesRepository->getUnreadNotifications($user_id);
    }
    // 既読にする
    public function changeReadFlg($notification_message)
    {
        $notification_message['read_flg'] = 1;
        $this->notificationMessagesRepository->save($notification_message);
    }
    // 登録
    public function createNotification($notificetion)
    {
        return $this->notificationMessagesRepository->save($notificetion);
    }
}
