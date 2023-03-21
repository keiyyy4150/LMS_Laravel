<?php
/**
 * スケジュールリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Schedule;
use Carbon\Carbon;

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

    /**
     * スケジュールを登録
     * @param $data
     * @return Schedule|null
     */
    public function save($data): ?Schedule
    {
        if (isset($data['id'])) {
            $schedule = Schedule::query()->findOrFail($data['id']);
        } else {
            $schedule = new Schedule();
        }

        foreach ($data as $key => $value) {
            if ($schedule->isFillable($key)) {
                $schedule->setAttribute($key, $value);
            }
        }

        $schedule->save();

        return $schedule;
    }

    /**
     * スケジュールを削除
     * @param int $schedule_id
     * @return true
     */
    public function DeleteSchedule(int $schedule_id)
    {
        $schedule = Schedule::find($schedule_id);

        if (!$schedule) {
            return false;
        }

        $schedule->delete();

        return true;
    }

    /**
     * タイマー機能
     * @param string $schedule
     * @param int $timer_flg
     * @return true
     */
    public function StartOrEndTask(string $schedule, int $timer_flg)
    {
        // 開始ボタン起動の場合
        if ($timer_flg == 0) {
            Schedule::query()
                ->where('id', $schedule)
                ->update([
                    'start_time' => Carbon::now(),
                ]);
        // 終了ボタン起動の場合
        } else if ($timer_flg == 1) {
            Schedule::query()
                ->where('id', $schedule)
                ->update([
                    'actual_time' => Carbon::now(),
                ]);
        }

        if ($timer_flg > 1) {
            abort(404);
            return false;
        }

        return true;
    }
}
