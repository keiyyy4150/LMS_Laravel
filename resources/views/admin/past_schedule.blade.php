@extends('layouts.layout')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="col-md-11">
    <div class="conteiner">
        <div class="search_result">
        <div class="result_schedules">
        <h4>【過去の学習状況】</h>
        <table class="table table-light table-bordered table-striped ">
            <thead class="thead-light">
                <tr><th>日付</th><th>リスト</th><th>科目</th><th>目標時間</th><!--<th>達成状況</th>--></tr>
            </thead>
            <tbody>
                @if(isset($schedules))
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule['created_at'] }}</td>
                            <td>{{ $schedule['content'] }}</td>
                            <td>{{ $schedule['subject'] }}</td>
                            <td>{{ $schedule['scheduled_time'] }}</td>
                            <!--<td>
                                @if( !isset($schedule['startTime']) && !isset($schedule['actual_time']) )
                                <p><font color="red">未達</font></p>
                                @elseif( isset($schedule['startTime']) && !isset($schedule['actual_time']) )
                                <p>進行中</p>
                                @elseif( isset($schedule['actual_time']) )
                                <p>完了</p>
                                @endif
                            </td>-->
                        </tr>
                    @endforeach
                    <input type="hidden" id="count" value="2">
                        <tbody id="tr">
                        </tbody>
                @endif
            </tbody>
            <div>
        </table>
        <button id=ajaxbutton data-user_id="{{ $user }}">もっと見る</button>
        </div>
        </div>
    </div>
</main>
@endsection
</div>
</body>
</html>