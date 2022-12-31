<?php
/**
 * お知らせサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\SettingRepositoryInterface;

class SettingService implements SettingServiceInterface
{
    protected $settingRepository;

    public function __construct(
        SettingRepositoryInterface $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    public function getSettingInformation()
    {
        return $this->settingRepository->getAllSettingInformation();
    }
}
