<?php
/**
 * スケジュールサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

interface ScheduleServiceInterface
{
    /**
     * スケジュール情報を取得
     * @param $user
     * @param $dt_from
     * @param $dt_to
     * @return void
     */
    public function getSchedulesPerDay($user, $dt_from, $dt_to);

    /**
     * スケジュール登録/編集
     * @param $data
     * @return void
     */
    public function createSchedule($data);

    /**
     * スケジュールを削除
     * @param int $schedule_id
     * @return true
     */
    public function DeleteSchedule(int $schedule_id);

    /**
     * タイマー機能
     * @param string $schedule
     * @param int $timer_flg
     * @return true
     */
    public function StartOrEndTask(string $schedule, int $timer_flg);
}
