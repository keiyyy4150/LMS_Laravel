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

    public function getSchedulesPerDay($user, $dt_from, $dt_to)
    {
        return $this->scheduleRepository->getSchedulesPerDay($user, $dt_from, $dt_to);
    }

    // スケジュールの登録・編集
    public function createSchedule($data){

        // トランザクション処理の開始
        DB::beginTransaction();

        $schedule = $this->scheduleRepository->save($data);

        // トランザクション処理の終了
        DB::commit();

        return $schedule;
    }
}
