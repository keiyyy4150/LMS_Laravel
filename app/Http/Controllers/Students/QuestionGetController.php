<?php
/**
* 質問ページ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\QuestionGetResponder as Responder;
use Illuminate\Http\Response;

class QuestionGetController extends Controller
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
