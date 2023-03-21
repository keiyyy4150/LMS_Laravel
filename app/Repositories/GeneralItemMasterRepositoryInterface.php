<?php
/**
 * マスターリポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Answer;

interface GeneralItemMasterRepositoryInterface
{
    /****************** 科目 ******************/
    /**
     * 全科目
     * @return array
     */
    public function getSubjects();
}
