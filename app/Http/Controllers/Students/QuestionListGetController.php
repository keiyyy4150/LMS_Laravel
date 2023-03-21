<?php
/**
* 質問部屋トップページ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\QuestionListGetResponder as Responder;
use App\Services\QuestionsServiceInterface;
use App\Services\MasterServiceInterface;
use Illuminate\Http\Response;

class QuestionListGetController extends Controller
{
    protected $Responder;
    protected $questionsService;
    protected $masterService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param QuestionsServiceInterface $questionsService レスポンダ
     * @param MasterServiceInterface $masterService レスポンダ
     */

    public function __construct(
        Responder $Responder,
        QuestionsServiceInterface $questionsService,
        MasterServiceInterface $masterService
    ){
        $this->Responder = $Responder;
        $this->questionsService = $questionsService;
        $this->masterService = $masterService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {
        // 質問を全て取得
        $questions = $this->questionsService->all();
        foreach ($questions as $question) {
            $question['number_of_answers'] = count($question->Answers);
        }
        // 未解決の質問を取得
        $unsolved_questions = $this->questionsService->getUnresolvedQuestions();
        // 未解決質問数
        $number_of_unsolved_questions = count($unsolved_questions);
        // 解決済みの質問を取得
        $resolved_questions = $this->questionsService->getResolvedQuestions();
        // 科目リストを取得
        $subjects = $this->masterService->getSubjects();

        return $this->Responder->response([
            'questions' => $questions,
            'unsolved_questions' => $unsolved_questions,
            'number_of_unsolved_questions' => $number_of_unsolved_questions,
            'resolved_questions' => $resolved_questions,
            'subjects' => $subjects
        ]);
    }
}
