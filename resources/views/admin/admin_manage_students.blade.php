@extends('layouts.layout')
@section('content')
<main class="col-md-11">
    <div class="conteiner">
        <a href="{{ route('admin.setting') }}">
           <button type='button' class='btn btn-danger'>総合管理画面に切り替える</button>
        </a>
    </div>
    <form action="{{ route('search.students') }}" method="POST">
    @csrf
        <div class="conteiner">
            <div class="card shadow">
                <div class="border">
                    <h4>【検索】</h>
                    <table>
                        <th>氏名<input type='text' class='form-control' name='name' value="{{ old('name') }}"></th>
                        <th>フリガナ<input type='text' class='form-control' name='kana' value="{{ old('kana') }}"></th>
                        <th>電話番号<input type='text' class='form-control' name='tel' value="{{ old('tel') }}"></th>
                        <th>メールアドレス<input type='text' class='form-control' name='email' value="{{ old('email') }}"></th>
                    </table>
                </div>
            </div>
        </div>
        <div class="conteiner">
            <div>
                <button type='submit' class='btn btn-primary'>検索</button>
                <a href='/admin_manage_students'><button type='button' class='btn btn-secondary'>クリア</button></a>
            </div>
        </div>
    </form>
    <form action="{{ route('show.students') }}" method="Get">
    @if(isset($user))
    <div class="conteiner">
        <div class="card shadow-sm">
            <div class="border">
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-dark">
                        <tr><th>選択</th><th>ID</th><th>氏名</th><th>受講コース</th><th>管理者切り替え</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='checkbox' name='id' value="{{ $user['id'] }}"/></td>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>@if(null !== $user['course_id'] ){{ $course['course_name'] }} @else {{ $course }} @endif</td>
                            <td>@if($user['role'] === 0)
                                <a href="{{ route('open.userRole', ['user' => $user['id']]) }}">
                                    <button type='button' class='btn btn-danger'>管理者に変更する</button>
                                </a>
                                @elseif($user['role'] === 1)
                                <a href="{{ route('close.userRole', ['user' => $user['id']]) }}">
                                <button type='button' class='btn btn-secondary'>管理者解除</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else

    @endif
    <div class="conteiner">
        <div>
            <button type='submit' class='btn btn-primary'>表示する</button>
        </div>
    </div>
    </form>
    <div class="conteiner">
        <div class="card shadow">
            <div class="border">
                <h4>【今日の学習状況】</h>
                @if(isset($user))
                <a href="{{ route('past.schedule', ['user' => $user['id']]) }}" ><font size="2">過去の学習状況</font></a>
                @endif
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr><th>リスト</th><th>科目</th><th>目標時間</th><th>開始時間</th><th>終了時間</th><th>達成状況</th></tr>
                    </thead>
                    <tbody>
                        @if(isset($schedules))
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule['content'] }}</td>
                                <td>{{ $schedule['subject'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule['scheduled_time'])->format('G時間i分') }}</td>
                                @if( !isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                <td>まだ開始していません。</td>
                                @else
                                <td>{{ $schedule['start_time']}}</td>
                                @endif
                                @if( !isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                <td>まだ終了していません。</td>
                                @elseif( isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                <td>現在進行中です。</td>
                                @elseif( isset($schedule['actual_time']) )
                                <td>{{ $schedule['actual_time'] }}</td>
                                @endif
                                <td>
                                @if( !isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                <p><font color="red">未達</font></p>
                                @elseif( isset($schedule['start_time']) && !isset($schedule['actual_time']) )
                                <p>進行中</p>
                                @elseif( isset($schedule['actual_time']) )
                                <p>完了</p>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="conteiner">
        <div class="card shadow">
            <div class="border">
                <h4>【課題提出状況】</h>
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr>
                            <th>課題名</th
                            ><th>ファイル</th>
                            <th>提出日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($submissions))
                            @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $submission['assignment']['assign_name'] }}</td>
                                <td>{{ $submission['submit_file'] }}</a></td>
                                <td>{{ $submission['created_at'] }}</td>
                            </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
    </div>
</body>
</html>
