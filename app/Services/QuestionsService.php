<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\QuestionsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionsService implements QuestionsServiceInterface
{
    protected $questionsRepository;

    public function __construct(
        QuestionsRepositoryInterface $questionsRepository
    ) {
        $this->questionsRepository = $questionsRepository;
    }

    //
}
