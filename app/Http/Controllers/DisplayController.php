<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Setting;
use App\Assignment;
use App\Course;
use App\Schedule;
use Carbon\Carbon;

class DisplayController extends Controller
{
    /**
     * 生徒用ホーム画面
     */
    public function index()
    {
        if(Auth::user()->role == 1) {

            return redirect('/admin_manage_students');

        }

        $users = Auth::user()->where('id', \Auth::user()->id)->get();

        $notice = Setting::all();

        $carbon = Carbon::now();
		$dt_from=$carbon->copy()->startOfDay();
		$dt_to=$carbon->copy()->endOfDay();

        $schedules = Auth::user()->schedule()->whereBetween('created_at', [$dt_from, $dt_to])->get();

        foreach($users as $user) {
            $current_time = new Carbon('Asia/Tokyo');
            $schedule_time = new Carbon($user['test_date']);
            $count = $current_time->diff($schedule_time)->days;
        }

        return view('students/students_home', [
            'notices' => $notice,
            'schedules' => $schedules,
            'count' => $count,
            'users' => $users,
        ]);
    }
    public function info()
    {
        $user = Auth::user()->where('id', \Auth::user()->id)->first();

        $course = Course::first()->where('id', $user->course_id)->first();

        return view('students/info', [
            'user' => $user,
            'course' => $course
        ]);
    }
    public function editInfo()
    {
        $courses = Course::all();

        $user = User::where('id', \Auth::user()->id)->first();

        return view('students/update_info', [
            'courses' => $courses,
            'user' => $user,
        ]);
    }
    /**
     * 課題提出チャンネル
     */
    public function assignList()
    {
        $message = '公開中の課題はありません';

        $assignList = Assignment::where('private_flg', 1)->where('course_id', \Auth::user()->course_id)->get();

        return view('students/students_assign', [
            'message' => $message,
            'assignLists' => $assignList,
        ]);
    }
    /**
     * 課題詳細
     */
    public function assignDetail(Assignment $assignment)
    {
        $result = $assignment->where('id', $assignment->id)->first();

        return view('students/assign_detail', [
            'assignDetails' => $result,
        ]);
    }
    /**
     * 課題提出フォーム
     */
    public function assignForm(Assignment $assignment)
    {
        $result = $assignment->where('id', $assignment->id)->first();

        return view('students/assign_submit', [
            'assignList' => $result,
        ]);
    }
    /**
     * 管理者生徒管理画面
     */
    public function index2()
    {
        return view('admin/admin_manage_students');
    }
    /**
     * 過去の学習状況画面
     */
    public function pastSchedule(User $user)
    {
        $schedules = Schedule::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20, ['*'], 'page', 1);

        return view('admin/past_schedule', [
            'schedules' => $schedules,
            'user' => $user->id,
        ]);
    }
    //ajaxに値を返す
    public function ajaxSchedule(User $user, Request $request)
    {
        $page = $request->count;

        $schedules = Schedule::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20, ['*'], 'page', $page);

        $param = ['schedule' => $schedules,];

        return response()->json($param);
    }


    /**
     * 管理者設定画面
     */
    public function index3()
    {
        $notice = Setting::find(1);

        $assignment = new Assignment;
        $assignList = $assignment->with('course')->get();

        $course = Course::all();

        return view('admin/admin_setting', [
            'notice' => $notice,
            'assignDetails' => $assignList,
            'courses' => $course,
        ]);
    }
}
