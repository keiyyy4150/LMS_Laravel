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
use Illuminate\Http\Response;

class QuestionListGetController extends Controller
{
    protected $Responder;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     */

    public function __construct(Responder $Responder)
    {
        $this->Responder = $Responder;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {

        $data = 'hello';

        return $this->Responder->response([
            'data' => $data
        ]);
    }
}
