<?php
/**
 * ********サービス
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Services;
use App\Question;

interface QuestionsServiceInterface
{
    /**
     * 質問全件取得
     * @return mixed
     */
    public function all();

    /**
     * 未解決の質問のみ取得
     * @return mixed
     */
    public function getUnresolvedQuestions();

    /**
     * 解決済みの質問のみ取得
     * @return mixed
     */
    public function getResolvedQuestions();

    /**
     * 解決済みの質問のみ取得
     * @param int $id
     * @return Question|null
     */
    public function getQuestionById($id);

    /**
     * ログインユーザーの質問取得
     * @param $user
     * @return Question|null
     */
    public function getMyQuestions($user);

    /**
     * 登録
     * $param array $data
     */
    public function createQuestion($data);
}
