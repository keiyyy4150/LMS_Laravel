@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">お知らせ一覧</div>
                <div class="card-body">
                    @foreach($notification_messages as $notification_messages)
                    <div class="text-left">
                        <a href="{{ route('notification-detail', ['id' => $notification_messages['id']]) }}">
                            <p>{{ $notification_messages['notification_title'] }}</p>
                        </a>
                        <p>{{ $notification_messages['created_at'] }}</p>
                    </div>
                    <hr class="style-one">
                    @endforeach
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
