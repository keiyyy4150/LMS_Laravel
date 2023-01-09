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

class UpdateSchedulePostController extends Controller
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
    public function __invoke(Request $request)
    {
        // データ成形
        $data = $request->post();
        $data['user_id'] = Auth::user()->id;

        // スケジュール登録メソッド
        $this->scheduleService->createSchedule($data);

        return $this->Responder->response($data);
    }
}
