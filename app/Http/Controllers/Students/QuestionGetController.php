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
use App\Http\Responders\Students\QuestionGetResponder as Responder;
use App\Services\MasterServiceInterface;
use Illuminate\Http\Response;

class QuestionGetController extends Controller
{
    protected $Responder;
    protected $masterService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param MasterServiceInterface $masterService レスポンダ
     */

    public function __construct(
        Responder $Responder,
        MasterServiceInterface $masterService
    ){
        $this->Responder = $Responder;
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
        // ユーザー情報取得
        $user = Auth::user();
        // 科目リストを取得
        $subjects = $this->masterService->getSubjects();

        return $this->Responder->response([
            'user' => $user,
            'subjects' => $subjects
        ]);
    }
}
