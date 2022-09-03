<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Assignment;
use App\Course;
use App\Schedule;

class DeleteController extends Controller
{
    /**
     * スケジュール削除
     */
    public function deleteSchedule(Schedule $schedule) {

        $result = $schedule->where('id', $schedule->id)->delete();

        return redirect('/');
    }
    /**
     * 課題削除
     */
    public function deleteAssign(Assignment $assignment) {

        $result = $assignment->delete();

        return redirect('/admin_setting');
    }
}

