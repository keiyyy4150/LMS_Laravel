<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;
use App\Answer;

interface AnswersServiceInterface
{
    /**
     * 質問番号から回答を取得
     * @param string $question_number
     * @return Answer|null
     */
    public function getAnswerByQuestionNumber($question_number);

    /**
     * ログインユーザーの質問取得
     * @param $user
     * @return Answer|null
     */
    public function getMyAnswers($user);

    /**
     * 回答の登録
     * @param array $data
     */
    public function createAnswer($data);
}
