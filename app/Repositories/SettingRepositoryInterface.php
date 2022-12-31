<?php
/**
 * お知らせリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

interface SettingRepositoryInterface
{
    /**
     * お知らせ情報を取得
     * @param null
     * @return void
     */
    public function getAllSettingInformation();
}
