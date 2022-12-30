<?php
/**
 * お知らせリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    /**
     * @param null
     * @return Setting
     */
    public function getAllSettingInformation()
    {
        return Setting::all();
    }
}
