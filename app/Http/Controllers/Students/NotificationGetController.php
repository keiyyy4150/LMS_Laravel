<?php
/**
* コントローラ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\NotificationGetResponder as Responder;
use App\Services\NotificationMessagesServiceInterface;
use Illuminate\Http\Response;

class NotificationGetController extends Controller
{
    protected $Responder;
    protected $notificationMessagesService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param NotificationMessagesServiceInterface $notificationMessagesService レスポンダ
     */

    public function __construct(

        Responder $Responder,
        NotificationMessagesServiceInterface $notificationMessagesService,

    ){
        $this->Responder = $Responder;
        $this->notificationMessagesService = $notificationMessagesService;
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {
        $user = Auth::user();

        $notification_messages = $this->notificationMessagesService->getNotificationsByUseID($user['id']);

        return $this->Responder->response([
            'users' => $user,
            'notification_messages' => $notification_messages,
        ]);
    }
}
