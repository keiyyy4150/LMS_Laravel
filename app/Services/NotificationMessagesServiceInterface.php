<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;
use App\NotificationMessage;

interface NotificationMessagesServiceInterface
{
    /**
     * ログインユーザーのお知らせ取得
     * @param int $user_id
     */
    public function getNotificationsByUseID($user_id);
    /**
     * お知らせ詳細を１件取得
     * @param int $id
     */
    public function getNotificationDetailByID($id);
    /**
     * 未読のお知らせ取得
     * @param int $user_id
     */
    public function getUnreadNotifications($user_id);
    /**
     * 既読にする
     * @param array $notification_message
     */
    public function changeReadFlg($notification_message);
    /**
     * お知らせ登録
     * @param array $notificetion
     */
    public function createNotification($notificetion);
}
