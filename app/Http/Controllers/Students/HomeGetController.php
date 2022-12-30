<?php

/* 生徒用画面トップページのコントローラ
*
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Responders\Students\HomeGetResponder as Responder;
use App\Services\UsersServiceInterface; // まだ作成してないので作成
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeGetAction extends Controller
{
    protected $Responder;
    /**
     * @var UsersServiceInterface
     */
    private $usersService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param UsersServiceInterface
     */

    public function __construct(

        Responder $Responder,
        UsersServiceInterface $usersService

    )
    {
        $this->Responder = $Responder;
        $this->usersService = $usersService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        // ユーザー情報取得
        // $users = Auth::user()->where('id', \Auth::user()->id)->get();

        // お知らせ情報の取得
        // $notice = Setting::all();

        // ホーム画面表示の日時ごとの切り替え
        // $carbon = Carbon::now();
        // $dt_from=$carbon->copy()->startOfDay();
        // $dt_to=$carbon->copy()->endOfDay();

        // 生徒情報の取得
        // $schedules = Auth::user()->schedule()->whereBetween('created_at', [$dt_from, $dt_to])->get();

        // foreach($users as $user) {
        //     $current_time = new Carbon('Asia/Tokyo');
        //     $schedule_time = new Carbon($user['test_date']);
        //     $count = $current_time->diff($schedule_time)->days;
        // }

        return $this->Responder->response([
            // 'notices' => $notice,
            // 'schedules' => $schedules,
            // 'count' => $count,
            // 'users' => $users,
        ]);
    }
}
