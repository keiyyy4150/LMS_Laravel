<?php
/**
 * ********リポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\NotificationMessage;
use Carbon\Carbon;

class NotificationMessagesRepository implements NotificationMessagesRepositoryInterface
{
    // ログインユーザーのお知らせ取得
    public function getNotificationsByUseID($user_id)
    {
        return NotificationMessage::query()
            ->where('user_id', '=', $user_id)
            ->get();
    }
    // お知らせ詳細を１件取得
    public function getNotificationDetailByID($id)
    {
        return NotificationMessage::query()
            ->where('id', '=', $id)
            ->first();
    }
    // 未読のお知らせ取得
    public function getUnreadNotifications($user_id)
    {
        return NotificationMessage::query()
            ->where('user_id', '=', $user_id)
            ->where('read_flg', '=', 0)
            ->get();
    }
    // お知らせ登録
    public function save($data)
    {
        if (isset($data['id'])) {
            $notification = NotificationMessage::query()->findOrFail($data['id']);
            $notification->read_flg = 1;
        } else {
            $notification = new NotificationMessage();
        }

        foreach ($data as $key => $value) {
            if ($notification->isFillable($key)) {
                $notification->setAttribute($key, $value);
            }
        }

        $notification->save();

        return $notification;
    }
}
