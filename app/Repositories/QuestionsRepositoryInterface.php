<?php
/**
 * ********リポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Question;

interface QuestionsRepositoryInterface
{
    /**
     * 質問全件取得
     * @return mixed
     */
    public function all();

    /**
     * 未解決の質問を取得
     * @return mixed
     */
    public function getUnresolvedQuestions();

    /**
     * 解決済みの質問を取得
     * @return mixed
     */
    public function getResolvedQuestions();

    /**
     * idから質問を取得
     * @param $id
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
     * @param $data
     */
    public function save($data);
}
