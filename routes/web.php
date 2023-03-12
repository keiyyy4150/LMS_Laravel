<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    // 生徒用トップページ
    // Route::get('/', 'DisplayController@index');
    Route::get('/', Students\HomeGetController::class)->name('students-home-get');
    // プロフィール画面
    Route::get('/info', 'DisplayController@info')->name('info');
    // 各種登録画面
    Route::get('/edit_info', 'DisplayController@editInfo');
    Route::post('/update_info/{user}', 'UpdateController@updateInfo')->name('update.info');
    // スケジュール作成
    Route::post('/submit_schedule', Students\SubmitSchedulePostController::class)->name('submit-schedule');
    // スケジュール編集
    Route::post('/update_schedule/{schedule}', Students\UpdateSchedulePostController::class)->name('update-schedule');
    // スケジュール削除
    // Route::get('/delete_schedule/{schedule}', 'DeleteController@deleteSchedule')->name('delete.schedule');
    Route::post('/delete_schedule/{schedule}', Students\DeleteSchedulePostController::class)->name('delete-schedule');
    // 課題開始
    Route::get('/start_schedule/{schedule}/{timer_flg}', Students\RealTimeScheduleGetController::class)->name('start.schedule');
    // 課題終了
    Route::get('/finish_schedule/{schedule}/{timer_flg}', Students\RealTimeScheduleGetController::class)->name('finish.schedule');


    // 課題提出チャンネル
    Route::get('/students_assign', 'DisplayController@assignList');
    // 課題詳細
    Route::get('/assign_detail/{assignment}', 'DisplayController@assignDetail')->name('assign.detail');
    // 課題提出画面
    Route::get('/assign_form/{assignment}', 'DisplayController@assignForm')->name('assign.form');
    // 課題提出
    Route::post('/submit_assign', 'CreateController@submitAssign')->name('assign.submit');

    // 質問部屋
    // トップ
    Route::get('/question_list', Students\QuestionListGetController::class)->name('question.list');
    Route::get('/question_detail', Students\QuestionDetailGetController::class)->name('question-detail.list');
    Route::get('/question', Students\QuestionGetController::class)->name('get.question');
    Route::get('/my_q_and_a_question', Students\MyQAGetController::class)->name('get.my-q-a');

    Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {

        // 管理者用トップページ（生徒管理）
        Route::get('/admin_manage_students', 'DisplayController@index2');
        // 生徒検索
        Route::post('/admin_manage_students', 'SearchController@search')->name('search.students');
        Route::get('/show/students', 'SearchController@show')->name('show.students');
        // 管理者変更
        Route::get('/open_userRole/{user}', 'UpdateController@openRole')->name('open.userRole');
        // 管理者解除
        Route::get('/close_userRole/{user}', 'UpdateController@closeRole')->name('close.userRole');
        // 過去の学習状況
        Route::get('/past/schedule/{user}', 'DisplayController@pastSchedule')->name('past.schedule');
        Route::post('/past/schedule/{user}', 'DisplayController@ajaxSchedule');

        // 管理者用トップページ（設定画面）
        Route::get('/admin_setting', 'DisplayController@index3')->name('admin.setting');
        // トップページお知らせ編集
        Route::post('/update_notice/{setting}', 'UpdateController@updateNotice')->name('update.notice');
        // 課題作成
        Route::post('/create_assign', 'CreateController@createAssign')->name('create.assign');
        // 課題公開
        Route::get('/open_assignment/{assignment}', 'UpdateController@openAssign')->name('open.assignment');
        // 課題非公開
        Route::get('/close_assignment/{assignment}', 'UpdateController@closeAssign')->name('close.assignment');
        // 課題編集
        Route::post('/update_assignment/{assignment}', 'UpdateController@updateAssign')->name('update.assignment');
        // 課題削除
        Route::get('/delete_assignment/{assignment}', 'DeleteController@deleteAssign')->name('delete.assignment');
    });

});
