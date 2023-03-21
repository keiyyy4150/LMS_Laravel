@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">質問の詳細</div>
                <div class="card text-left">
                    <div class="card-body card-img-top left_space pre-scrollable">
                    <p>タイトル：{{ $question['title'] }}</p>
                        <div class="border">
                            <p>{{ $question['name'] }}さん</p>
                            <p>{{ $question['question'] }}</p>
                            <p>回答希望期限：{{ $question['answer_deadline'] }}</p>
                        </div>
                        <p></p>
                        <div class="border pre-scrollable">
                        <div class="text-center">
                            <form action="{{ route('post.answer_form') }}" method="post">
                            @csrf
                                <label>回答を入力</label>
                                <input type="hidden" name="question_number" value="{{ $question['question_number'] }}">
                                <input type="hidden" name="questioners_id" value="{{ $question['questioners_id'] }}">
                                <textarea rows="5" class="form-control" name="answer"></textarea>
                                <button type='submit' class='btn btn-secondary'>送信する</button>
                            </form>
                        </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}">
                                <button type='button' class='btn btn-secondary'>戻る</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        <a href="{{ route('students-home-get') }}">
            <button type='button' class='btn btn-secondary'>トップページへ戻る</button>
        </a>
    </div>
    </div>
</main>
@endsection
    </div>
</body>
</html>
