<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Http\Requests\CreateDataforInfo;
use App\Http\Requests\CreateDataforSettings;
use App\Http\Requests\CreateDataforAssign;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Assignment;
use App\Schedule;
use App\User;
use Carbon\Carbon;

class UpdateController extends Controller
{
    /**
     * プロフィール編集
     */
    public function updateInfo(CreateDataforInfo $request)
    {
        $updateUser = $request->all();

        if ($request->images != null) {
            $profileImagePath = $request->file('images')->store('public/profiles');
            $updateUser['images'] = $profileImagePath;
        }

        $loginUser = Auth::user();
        $loginUser->fill($updateUser)->save();

        return redirect('/');
    }
    /**
     * スケジュール編集
     */
    public function updateSchedule(Schedule $schedule, CreateData $request)
    {
        $record = $schedule;

        $columns = ['content', 'subject', 'scheduled_time'];

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();

        return redirect('/');
    }
    /**
     * スタート
     */
    public function startSchedule(Schedule $schedule)
    {
        $schedule->where('id', $schedule->id)->update([
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }
    /**
     * ストップ
     */
    public function finishSchedule(Schedule $schedule)
    {
        $schedule->where('id', $schedule->id)->update([
            'actual_time' => Carbon::now(),
        ]);

        return redirect('/');
    }


    /**
     * お知らせ編集
     */
    public function updateNotice(Setting $setting, CreateDataforSettings $request)
    {
        $record = $setting->find(1);

        $record->notice = $request->notice;

        $record->save();

        return redirect('admin_setting');
    }
    /**
     * 課題公開
     */
    public function openAssign(Assignment $assignment)
    {
        $assignment->where('id', $assignment->id)->update([
            'private_flg' => 1,
        ]);

        return redirect('admin_setting');
    }
    /**
     * 課題非公開
     */
    public function closeAssign(Assignment $assignment)
    {
        $assignment->where('id', $assignment->id)->update([
            'private_flg' => 0,
        ]);

        return redirect('admin_setting');
    }
    /**
     * 課題編集
     */
    public function updateAssign(Assignment $assignment, CreateDataforAssign $request)
    {
        $record = $assignment;

        $columns = ['assign_name', 'explanation', 'deadline', 'course_id'];

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }
        $record->save();

        return redirect('admin_setting');
    }
    /**
     * 管理者切り替え
     */
    public function openRole(User $user)
    {
        $user->where('id', $user->id)->update([
            'role' => 1,
        ]);

        return redirect('admin_manage_students');
    }
    public function closeRole(User $user)
    {
        $user->where('id', $user->id)->update([
            'role' => 0,
        ]);

        return redirect('admin_manage_students');
    }
}

