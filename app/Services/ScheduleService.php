<?php
/**
 * スケジュールサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\ScheduleRepositoryInterface;

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
}
