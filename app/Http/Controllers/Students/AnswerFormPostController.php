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
use App\Http\Responders\Students\AnswerFormPostResponder as Responder;
use App\Services\AnswersServiceInterface;
use App\Services\NotificationMessagesServiceInterface;

class AnswerFormPostController extends Controller
{
    protected $Responder;
    protected $answersService;
    protected $notificationMessagesService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param AnswersServiceInterface $answersService レスポンダ
     * @param NotificationMessagesServiceInterface $notificationMessagesService レスポンダ
     */

    public function __construct(
        Responder $Responder,
        AnswersServiceInterface $answersService,
        NotificationMessagesServiceInterface $notificationMessagesService,
    ){
        $this->Responder = $Responder;
        $this->answersService = $answersService;
        $this->notificationMessagesService = $notificationMessagesService;
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
        $data['answerers_id'] = $user['id'];
        $this->answersService->createAnswer($data);

        // お知らせ機能へ連携
        $notificetion = [
            'notification_title' => 'あなたの質問に回答がつきました',
            'notification_message' => 'あなたの質問に回答がつきました。回答を確認してアクションを起こしましょう！',
            'notification_url' => route('question-detail.list', ['id' => $data['question_number']]),
            'user_id' => $data['questioners_id'],
        ];
        $this->notificationMessagesService->createNotification($notificetion);

        return $this->Responder->response($data);
    }
}
