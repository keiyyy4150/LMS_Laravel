<?php
/**
 * ********リポジトリ
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Repositories;

use App\Answer;
use Carbon\Carbon;

class AnswersRepository implements AnswersRepositoryInterface
{
    // 回答番号から回答取得
    public function getAnswerByQuestionNumber($question_number)
    {
        return Answer::query()
            ->with('User')
            ->with('Comments')
            ->where('question_number', '=', $question_number)
            ->get();
    }
    // ログインユーザーの回答取得
    public function getMyAnswers($user)
    {
        return Answer::query()
            ->where('answerers_id', '=', $user->id)
            ->get();
    }
    // 回答の登録
    public function save($data)
    {
        if (isset($data['id'])) {
            $answer = Answer::query()->findOrFail($data['id']);
        } else {
            $answer = new Answer();
        }

        foreach ($data as $key => $value) {
            if ($answer->isFillable($key)) {
                $answer->setAttribute($key, $value);
            }
        }
        $answer->answer_number = $this->getNextCode();

        $answer->save();

        return $answer;
    }
    // 回答番号自動採番
    public function getNextCode(): string
    {
        $last_record = Answer::query()
            ->orderByDesc('answer_number')
            ->first('answer_number');

        if ($last_record === null) {
            $last_code = 0;
        } else {
            $last_code = (int)$last_record->answer_number;
        }

        return str_pad($last_code + 1, 14, '0', STR_PAD_LEFT);
    }
}
