@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">My Q And A</div>
                <div class="tab_content_description">
                    <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                        @foreach($questions as $question)
                            @if($question['status'] === 0)
                            <p><font color="#ff0000">回答受付中！</font></p>
                            @elseif($question['status'] === 1)
                            <p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            @endif
                            <div>
                                <a href="{{ route('question-detail.list', ['id' => $question['id']]) }}"><p>{{ $question['title'] }}</p></a>
                            </div>
                            <hr class="style-one">
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <a href="{{ url()->previous() }}">
                <button type='button' class='btn btn-secondary'>戻る</button>
            </a>
        </div>
    </div>
</main>
@endsection
    </div>
</body>
</html>
