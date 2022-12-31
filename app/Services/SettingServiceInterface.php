<?php
/**
 * お知らせサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

interface SettingServiceInterface
{
    /**
     * お知らせ情報を取得
     * @param null
     * @return void
     */
    public function getSettingInformation();
}
