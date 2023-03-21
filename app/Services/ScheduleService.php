<?php
/**
 * スケジュールサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\ScheduleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ScheduleService implements ScheduleServiceInterface
{
    protected $scheduleRepository;

    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * スケジュール情報を取得
     * @param $user
     * @param $dt_from
     * @param $dt_to
     * @return void
     */
    public function getSchedulesPerDay($user, $dt_from, $dt_to)
    {
        return $this->scheduleRepository->getSchedulesPerDay($user, $dt_from, $dt_to);
    }

    /**
     * スケジュール登録/編集
     * @param $data
     * @return void
     */
    public function createSchedule($data){

        // トランザクション処理の開始
        DB::beginTransaction();

        $schedule = $this->scheduleRepository->save($data);

        // トランザクション処理の終了
        DB::commit();

        return $schedule;
    }

    /**
     * スケジュールを削除
     * @param int $schedule_id
     * @return true
     */
    public function DeleteSchedule(int $schedule_id){

        // トランザクション処理の開始
        DB::beginTransaction();

        $this->scheduleRepository->DeleteSchedule($schedule_id);

        // トランザクション処理の終了
        DB::commit();

        return true;
    }

    /**
     * タイマー機能
     * @param string $schedule
     * @param int $timer_flg
     * @return true
     */
    public function StartOrEndTask(string $schedule, int $timer_flg){

        // トランザクション処理の開始
        DB::beginTransaction();

        $this->scheduleRepository->StartOrEndTask($schedule, $timer_flg);

        // トランザクション処理の終了
        DB::commit();

        return true;
    }
}
