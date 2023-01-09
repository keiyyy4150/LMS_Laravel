<?php
/**
* タイマー機能管理コントローラ
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responders\Students\SubmitSchedulePostResponder as Responder;
use App\Services\ScheduleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RealTimeScheduleGetController extends Controller
{
    protected $Responder;
    /**
     * @var ScheduleServiceInterface
     */
    private $scheduleService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param ScheduleServiceInterface
     */

    public function __construct(

        Responder $Responder,
        ScheduleServiceInterface $scheduleService

    )
    {
        $this->Responder = $Responder;
        $this->scheduleService = $scheduleService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $timer_flg ※0:スタート　1:ストップ
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $schedule, int $timer_flg)
    {
        // タイマー処理
        $this->scheduleService->StartOrEndTask($schedule, $timer_flg);

        // リダイレクト
        return $this->Responder->response($schedule);
    }
}
