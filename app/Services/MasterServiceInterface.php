<?php
/**
 * マスタサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;
use App\GeneralItemMaster;

interface MasterServiceInterface
{
    /****************** 科目 ******************/
    /**
     * 全科目を取得
     * @return array
     */
    public function getSubjects();
}
