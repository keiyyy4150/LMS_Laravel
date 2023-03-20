<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;

use App\Repositories\AnswersRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnswersService implements AnswersServiceInterface
{
    protected $answersRepository;

    public function __construct(
        AnswersRepositoryInterface $answersRepository
    ) {
        $this->answersRepository = $answersRepository;
    }

    //
}
