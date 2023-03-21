<?php
/**
 * マスターサービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\GeneralItemMasterRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MasterService implements MasterServiceInterface
{
    protected $generalItemMasterRepository;

    public function __construct(
        GeneralItemMasterRepositoryInterface $generalItemMasterRepository
    ) {
        $this->generalItemMasterRepository = $generalItemMasterRepository;
    }

    /****************** 科目 ******************/
    public function getSubjects()
    {
        return $this->generalItemMasterRepository->getSubjects();
    }
}
