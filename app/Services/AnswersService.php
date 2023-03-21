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
    // 回答番号から回答取得
    public function getAnswerByQuestionNumber($question_number)
    {
        return $this->answersRepository->getAnswerByQuestionNumber($question_number);
    }
    // ログインユーザーの回答取得
    public function getMyAnswers($user)
    {
        return $this->answersRepository->getMyAnswers($user);
    }
    // 回答を登録
    public function createAnswer($data)
    {
        return $this->answersRepository->save($data);
    }
}
