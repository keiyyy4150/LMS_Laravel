<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\TentativeQuestionsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TentativeQuestionsService implements TentativeQuestionsServiceInterface
{
    protected $tentativeQuestionsRepository;

    public function __construct(
        TentativeQuestionsRepositoryInterface $tentativeQuestionsRepository
    ) {
        $this->tentativeQuestionsRepository = $tentativeQuestionsRepository;
    }

    //
}
