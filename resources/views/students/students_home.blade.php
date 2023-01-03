@extends('layouts.layout')
@section('content')

    <div class="bg-success">
        <div class=bg-box>
        <img src="./character.png" alt="イメージキャラクター" width="130" height="180">
            <div class="balloon">
                <!-- ここはいずれDB作成して導入する -->
                <h>{{ Auth::user()->name }}さん、こんにちは！<br>今日もがんばりましょう！<br>継続は力なり！</br></h>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="scroll">
            <div class="news"><font color="yellow">
                @foreach($notices as $notice)
                <h2 align="middle">{{ $notice['notice'] }}</h>
                @endforeach
        </font></div>
        </div>
    </div>
    <!-- バリデーション　-->
    <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <!-- バリデーションここまで　-->
    <main class="col-md-12">
            <div class="tabs">
                <input id="schedule" type="radio" name="tab_item" checked>
                    <label class="tab_item" for="schedule">学習進捗</label>
                <input id="test" type="radio" name="tab_item">
                    <label class="tab_item" for="test">テスト成績</label>
                <input id="channel" type="radio" name="tab_item">
                    <label class="tab_item" for="channel">チャンネル</label>
            <div class="tab_content" id="schedule_content">
                <div class="tab_content_description">
                <!--学習進捗内容-->
                    <div class=col-md-1>
                        <div class="count-down"><h2>入試まであと{{ $count }}日</h></div>
                    </div>
                    <div class="card shadow">
                        <!-- 1.モーダル表示のためのボタン -->
                        <div class="card-header bg-dark text-white">本日のスケジュール
                            <button type='button' class='btn-secondary:hover'
                                    data-toggle="modal" data-target="#modal-example">スケジュールを入力する</button></div>
                            <!-- 2.モーダルの配置 -->
                            <div class="modal" id="modal-example" tabindex="-1">
                                <div class="modal-dialog">
                                    <!-- 3.モーダルのコンテンツ -->
                                    <div class="modal-content">
                                        <!-- 4.モーダルのヘッダ -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- 5.モーダルのボディ -->
                                        <div class="modal-body">
                                        <form action="{{ route('submit-schedule') }}" method="post">
                                            @csrf
                                            <label for='content'>内容<span class="badge badge-danger">必須</span></label>
                                                <input type='text' class='form-control' name='content' value="{{ old('content') }}"/>
                                            <label for='subject'>科目名<span class="badge badge-danger">必須</span></label>
                                                <input type='text' class='form-control' name='subject' value="{{ old('subject') }}"/>
                                            <label for='scheduled_time'>目標時間<span class="badge badge-danger">必須</span></label>
                                                <input type='time' class='form-control' name='scheduled_time' value="{{ old('scheduled_time') }}"/>
                                        </div>
                                    <!-- 6.モーダルのフッタ -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">保存</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>リスト</th>
                                        <th scope='col'>科目</th>
                                        <th scope='col'>目標時間</th>
                                        <th scope='col'>タイマー</th>
                                        <th scope='col'>達成状況</th>
                                        <th scope='col'>設定</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ここに学習進捗を表示 -->
                                    <tr>@foreach($schedules as $schedule)
                                        <th scope='col'>{{ $schedule['content'] }}</th>
                                        <th scope='col'>{{ $schedule['subject'] }}</th>
                                        <th scope='col'>{{ \Carbon\Carbon::parse($schedule['scheduled_time'])->format('G時間i分') }}</th>
                                        <th scope='col'>
                                            @if( !isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                            <a href="{{ route('start.schedule', ['schedule' => $schedule['id']]) }}">
                                                <button type='button' class='btn btn-primary'>開始する</button>
                                            </a>
                                            @elseif( isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                            <a href="{{ route('finish.schedule', ['schedule' => $schedule['id']]) }}">
                                                <button type='button' class='btn btn-warning'>終了する</button><br>
                                            </a>
                                            <font color="gray"> -開始時刻- <br> {{ \Carbon\Carbon::parse($schedule['start_time'])->format('G時i分') }} </font>
                                            @elseif( isset($schedule['actual_time']) )
                                                この課題は完了しました。<br>
                                                <font color="gray"> -開始時刻- <br> {{ \Carbon\Carbon::parse($schedule['start_time'])->format('G時i分') }} </font> <br>
                                                <font color="gray"> -終了時刻- <br> {{ \Carbon\Carbon::parse($schedule['actual_time'])->format('G時i分') }} </font>
                                            @endif
                                        </th>
                                        <th scope='col'>
                                            @if( !isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                            <p><font color="red">未達</font></p>
                                            @elseif( isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                            <p>進行中</p>
                                            @elseif( isset($schedule['actual_time']) )
                                            <p>完了</p>
                                            @endif
                                        </th>
                                        <td><button type="button" data-toggle="modal" data-target="#update_schedule{{ $schedule['id'] }}">編集</button>&emsp;<a href="{{ route('delete.schedule', ['schedule' => $schedule['id']]) }}"><button type="button">削除</button></a></td></tr>
                                        <div class="modal" id="update_schedule{{ $schedule['id'] }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ route('update.schedule', ['schedule' => $schedule['id']]) }}" method="post">
                                                        @csrf
                                                            <input type='hidden' name='id' value="{{ $schedule['id'] }}"/>
                                                        <label for='content'>内容<span class="badge badge-danger">必須</span></label>
                                                            <input type='text' class='form-control' name='content' value="{{ $schedule['content'] }}"/>
                                                        <label for='subject'>科目名<span class="badge badge-danger">必須</span></label>
                                                            <input type='text' class='form-control' name='subject' value="{{ $schedule['subject'] }}"/>
                                                        <label for='scheduled_time'>目標時間<span class="badge badge-danger">必須</span></label>
                                                            <input type='time' class='form-control' name='scheduled_time' value="{{ $schedule['scheduled_time'] }}"/>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                                    <button type="submit" class="btn btn-primary">保存</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </tr>@endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab_content" id="test_content" align="middle">
                <div class="tab_content_description">
                <!--テスト成績内容-->
                <h1>Comming Soon!</h>
                </div>
            </div>
                <div class="tab_content" id="channel_content" align="middle">
                    <div class="tab_content_description">
                    <div class="card shadow-ch">
                            <div class="card-header bg-dark text-white">課題提出チャンネル</div>
                            <div class="card-body">
                                <a href="./students_assign">
                                    <button type='button' class='btn btn-secondary'>チャンネルへ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
@endsection
    </div>
</body>
</html>
