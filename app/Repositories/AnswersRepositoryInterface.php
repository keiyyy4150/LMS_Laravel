<?php
/**
 * ********リポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Answer;

interface AnswersRepositoryInterface
{
    /**
     * 質問番号から質問を取得
     * @param $question_number
     * @return Answer|null
     */
    public function getAnswerByQuestionNumber($question_number);

    /**
     * ログインユーザーの回答取得
     * @param $user
     * @return Answer|null
     */
    public function getMyAnswers($user);

    /**
     * 回答の登録
     * @param array $data
     */
    public function save($data);
}
