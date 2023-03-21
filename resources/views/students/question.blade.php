@push('scripts')
    <script src="{{ asset('/js/question.js') }}" defer></script>
@endpush

@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
        <div class="card-header bg-dark text-white text-center">課題の詳細</div>
                <div class="card-body">
                    <form action="{{ route('post.question') }}" method="post">
                    @csrf
                    <div class="text-left">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">科目</label>
                            <div class="col-sm-10">
                                <select name='subject' class='form-control'>
                                    <option value="" hidden>科目を選択してください</option>
                                    @foreach($subjects as $key => $subject)
                                        <option value="{{ $key }}">{{ $subject }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">カテゴリー</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="category" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">タイトル</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="form-control"
                                          name="question"
                                          type="text">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">画像(任意)</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">希望回答期限</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="answer_deadline" type="date">
                            </div>
                        </div>
                    </div>
                    <!-- ボタンエリア -->
                    <div class="button_area">
                        <div class="text-center">
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary inline-btn">戻る</button>
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary inline-btn" disabled>一時保存</button>
                            </a>
                        </div>
                        <div class="text-center">
                                <button type="submit" class="btn btn-secondary inline-btn">一般公開</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        <a href="./">
            <button type='button' class='btn btn-secondary'>トップページへ戻る</button>
        </a>
    </div>
    </div>
</main>
@endsection
    </div>
</body>
</html>
