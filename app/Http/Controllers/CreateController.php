<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateDataforSubmissions;
use App\Http\Requests\CreateDataforAssign;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\Schedule;
use App\Submission;

class CreateController extends Controller
{
    /**
     * スケジュール提出
     */
    public function submitSchedule(CreateData $request)
    {
        $schedule = new Schedule;

        $columns = ['content', 'subject', 'scheduled_time'];
        foreach($columns as $column) {
            $schedule->$column = $request->$column;
        }

        Auth::user()->schedule()->save($schedule);

        return redirect('/');
    }
    /**
     * 課題提出
     */
    public function submitAssign(CreateDataforSubmissions $request)
    {

        $submission = new Submission;

        $submission->assigned_id = $request->assigned_id;

        if ($request->submit_file != null) {
            $file_name = $request->file('submit_file')->getClientOriginalName();
            $path = $request->file('submit_file')->storeAs('public/files', $file_name);
            $submission['submit_file'] = $path;
        }

        Auth::user()->submission()->save($submission, $path);

        return redirect('students_assign');
    }
    /**
     * 課題作成
     */
    public function createAssign(CreateDataforAssign $request)
    {
        $assignList = new Assignment;

        $columns = ['assign_name', 'explanation', 'deadline', 'course_id'];
        foreach($columns as $column) {
            $assignList->$column = $request->$column;
        }

        $assignList->save();

        return redirect('admin_setting');
    }
}
