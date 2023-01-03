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

    // public function getNextCode(): string
    // {
    //     $last_record = Purchase::query()
    //         ->orderByDesc('purchase_voucher_number')
    //         ->first('purchase_voucher_number');

    //     if ($last_record === null) {
    //         $last_code = 0;
    //     } else {
    //         $last_code = (int)$last_record->purchase_voucher_number;
    //     }

    //     return str_pad($last_code + 1, config('const.code_length.purchase_voucher_number'), '0', STR_PAD_LEFT);
    // }
}
