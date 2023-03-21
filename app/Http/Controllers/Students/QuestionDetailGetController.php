<?php
/**
* 質問部屋トップページ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\QuestionDetailGetResponder as Responder;
use App\Services\QuestionsServiceInterface;
use App\Services\AnswersServiceInterface;
use Illuminate\Http\Response;

class QuestionDetailGetController extends Controller
{
    protected $Responder;
    protected $questionsService;
    protected $answersService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param QuestionsServiceInterface $questionsService レスポンダ
     * @param AnswersServiceInterface $answersService レスポンダ
     */

    public function __construct(
        Responder $Responder,
        QuestionsServiceInterface $questionsService,
        AnswersServiceInterface $answersService,
    ){
        $this->Responder = $Responder;
        $this->questionsService = $questionsService;
        $this->answersService = $answersService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $id): Response
    {
        // ユーザー情報取得
        $user = Auth::user();
        // idから質問を取得
        $question = $this->questionsService->getQuestionById($id);
        $qustioner = $question->User;
        $question['name'] = $qustioner['name'] ?? null;
        // 質問番号から回答を取得
        $question['answer'] = $this->answersService->getAnswerByQuestionNumber($question['question_number']);
        foreach ($question['answer'] as $answer) {
            $answerer = $answer->User;
            $answer['name'] = $answerer['name'] ?? null;
            $answer['comments'] = $answer->Comments->toArray();
        }

        return $this->Responder->response([
            'user' => $user,
            'question' => $question
        ]);
    }
}
