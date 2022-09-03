<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Submission;
use App\Schedule;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request) {

        $user = User::where('name', $request->name)->orwhere('kana', $request->kana)->orwhere('tel', $request->tel)->orwhere('email', $request->email)->first();

        if( isset($user['course_id']) ) {
        $course = Course::first()->where('id', $user->course_id)->first();
        }else{
        $course = "コースが登録されていません";
        }

        return view('admin/admin_manage_students',[
            'course' => $course,
            'user' => $user,
        ]);
    }
    public function show(Request $request) {

        $user = User::where('id', $request->id)->first();

        if( isset($user['course_id']) ) {
        $course = Course::first()->where('id', $user->course_id)->first();
        }else{
        $course = "コースが登録されていません";
        }

        $carbon = Carbon::now();
		$dt_from=$carbon->copy()->startOfDay();
		$dt_to=$carbon->copy()->endOfDay();

        $schedules = Schedule::where('user_id', $request->id)->whereBetween('created_at', [$dt_from, $dt_to])->get()->toArray();
        $submissions = Submission::with('assignment')->where('user_id', $request->id)->get()->toArray();

        return view('admin/admin_manage_students',[
            'user' => $user,
            'course' => $course,
            'schedules' => $schedules,
            'submissions' => $submissions,
        ]);
    }
}
