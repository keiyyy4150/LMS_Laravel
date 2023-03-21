<?php
/**
 * マスターリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

// 現時点でDB作成は未定
class GeneralItemMasterRepository implements GeneralItemMasterRepositoryInterface
{
    public function getSubjects()
    {
        $subjects = [
            '0' => '英語',
            '1' => '国語',
            '2' => '数学',
            '3' => '日本史',
            '4' => '世界史',
            '5' => '地理',
            '6' => '政治経済',
            '7' => '現代社会',
        ];

        return $subjects;
    }
}
