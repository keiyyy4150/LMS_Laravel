<?php
/**
* 質問ページ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\QuestionPostResponder as Responder;
use App\Services\QuestionsServiceInterface;
use App\Services\MasterServiceInterface;
use Illuminate\Http\Response;

class QuestionPostController extends Controller
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
    public function __invoke(Request $request)
    {
        // ユーザー情報取得
        $user = Auth::user();
        $data = $request->post();
        $data['questioners_id'] = $user['id'];

        // データ作成処理
        $this->questionsService->createQuestion($data);

        return $this->Responder->response($data);
    }
}
