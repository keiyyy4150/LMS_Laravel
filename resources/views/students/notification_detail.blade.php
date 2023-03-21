@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">お知らせ一覧</div>
                <div class="card-body">
                    <div class="text-left">
                        <p>{{ $notification_message['notification_title'] }}</p>
                        <a href="{{ $notification_message['notification_url'] }}"><p>{{ $notification_message['notification_message'] }}</p></a>
                        <p>{{ $notification_message['created_at'] }}</p>
                    </div>
                    <hr class="style-one">
                    <div class="text-center">
                        <a href="{{ route('students-home-get') }}">
                            <button type='button' class='btn btn-secondary'>Topページへ戻る</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
</div>
</body>
</html>
