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

    // 質問全件取得
    public function all()
    {
        return $this->questionsRepository->all();
    }
    // 未解決の質問を取得
    public function getUnresolvedQuestions()
    {
        return $this->questionsRepository->getUnresolvedQuestions();
    }
    // 解決済みの質問を取得
    public function getResolvedQuestions()
    {
        return $this->questionsRepository->getResolvedQuestions();
    }
    // idで取得
    public function getQuestionById($id)
    {
        return $this->questionsRepository->getQuestionById($id);
    }
    // ログインユーザーの質問取得
    public function getMyQuestions($user)
    {
        return $this->questionsRepository->getMyQuestions($user);
    }
    // 登録
    public function createQuestion($data)
    {
        return $this->questionsRepository->save($data);
    }
}
