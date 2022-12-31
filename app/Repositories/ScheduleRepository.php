<?php
/**
 * スケジュールリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Schedule;

class ScheduleRepository implements ScheduleRepositoryInterface
{
     /**
     * スケジュール情報を取得
     * @param $user
     * @param $dt_from
     * @param $dt_to
     * @return void
     */
    public function getSchedulesPerDay($user, $dt_from, $dt_to)
    {
        $schedules = Schedule::query()
            ->where('user_id', $user['id'])
            ->whereBetween('created_at', [$dt_from, $dt_to]);

        return $schedules->get();
    }
}
