<?php
/**
* 質問部屋トップページ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\QuestionPostResponder as Responder;
use App\Services\QuestionsServiceInterface;
use App\Services\AnswersServiceInterface;

class QuestionDetailCloseController extends Controller
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
    public function __invoke(Request $request)
    {
        $data = $request->post();

        // データ変更処理
        $this->questionsService->createQuestion($data);

        return $this->Responder->response($data);
    }
}
