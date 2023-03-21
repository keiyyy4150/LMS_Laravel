<?php
/**
* スケジュール編集用コントローラ
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

class DeleteSchedulePostController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $schedule_id)
    {
        // スケジュール削除メソッド
        $this->scheduleService->DeleteSchedule($schedule_id);

        return $this->Responder->response($schedule_id);
    }
}
