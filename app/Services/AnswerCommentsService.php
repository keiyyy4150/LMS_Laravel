<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\AnswerCommentsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnswerCommentsService implements AnswerCommentsServiceInterface
{
    protected $answerCommentsRepository;

    public function __construct(
        AnswerCommentsRepositoryInterface $answerCommentsRepository
    ) {
        $this->answerCommentsRepository = $answerCommentsRepository;
    }

    //
}
