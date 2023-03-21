<?php
/**
 * ********リポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Question;
use Carbon\Carbon;

class QuestionsRepository implements QuestionsRepositoryInterface
{
    // 質問を全件取得
    public function all()
    {
        return Question::orderBy('created_at', 'desc')
            ->with('Answers')
            ->get();
    }
    // 未解決の質問を取得
    public function getUnresolvedQuestions()
    {
        return Question::query()
            ->where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    // 解決済みの質問を取得
    public function getResolvedQuestions()
    {
        return Question::query()
            ->where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    // idで質問検索
    public function getQuestionById($id)
    {
        return Question::query()
            ->with('User')
            ->where('id', '=', $id)
            ->first();
    }
    // ログインユーザーの質問取得
    public function getMyQuestions($user)
    {
        return Question::query()
            ->where('questioners_id', '=', $user->id)
            ->get();
    }
    // 登録
    public function save($data)
    {
        if (isset($data['id'])) {
            $question = Question::query()->findOrFail($data['id']);
        } else {
            $question = new Question();
        }

        foreach ($data as $key => $value) {
            if ($question->isFillable($key)) {
                $question->setAttribute($key, $value);
            }
        }
        $question->question_number = $this->getNextCode();

        $question->save();

        return $question;
    }
    // 質問番号自動採番
    public function getNextCode(): string
    {
        $last_record = Question::query()
            ->orderByDesc('question_number')
            ->first('question_number');

        if ($last_record === null) {
            $last_code = 0;
        } else {
            $last_code = (int)$last_record->question_number;
        }

        return str_pad($last_code + 1, 14, '0', STR_PAD_LEFT);
    }
}
