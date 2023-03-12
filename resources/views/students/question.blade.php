@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
        <div class="card-header bg-dark text-white text-center">課題の詳細</div>
                <div class="card-body">
                    <div class="text-left">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">科目</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="form-control" type="text"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">画像(任意)</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text">
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
                                <button type="button" class="btn btn-secondary inline-btn">一時保存</button>
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary inline-btn">一般公開</button>
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary inline-btn">講師に質問</button>
                            </a>
                        </div>
                    </div>
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
