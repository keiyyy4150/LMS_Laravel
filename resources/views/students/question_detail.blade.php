@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">質問の詳細</div>
                <div class="card-2 text-left">
                    <div class="card-body-2 card-img-top left_space pre-scrollable">
                    @if($question['status'] === 0)
                    <p><font color="#ff0000">回答受付中！</font></p>
                    @elseif($question['status'] === 1)
                    <p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                    @endif
                    <p>タイトル：{{ $question['title'] }}</p>
                        <div class="border">
                            <p>{{ $question['name'] }}さん</p>
                            <p>{{ $question['question'] }}</p>
                            <p>回答希望期限：{{ $question['answer_deadline'] }}</p>
                        </div>
                        <!-- 回答受付中かつログインユーザーが質問者 -->
                        @if($user['id'] === $question['questioners_id'] && $question['status'] === 0)
                        <div class="text-center">
                            <button type="button" class="btn btn-danger"
                                    data-toggle="modal" data-target="#modal-close">クローズする</button>
                            <!-- モーダル -->
                            <div class="modal" id="modal-close" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('question-detail.close') }}" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>質問をクローズします。よろしいですか？</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $question['id'] }}">
                                            <!-- クローズ理由 -->
                                            <div>
                                                <label for="reason">クローズ理由を選択してください</label>
                                                <select name="status" class="form-control">
                                                    <option value="" hidden>理由を選択</option>
                                                    <option value="1">解決した</option>
                                                    <option value="2">取り消したい</option>
                                                </select>
                                            </div>
                                            <!-- メッセージ -->
                                            <div>
                                                <label for="reason">感謝の気持ちを伝えましょう</label>
                                                <input type="text" class="form-control" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                            <button type="submit" class="btn btn-primary">選択してクローズする</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- / モーダル -->
                        </div>
                        <!-- 回答受付中かつログインユーザーが質問者でない場合 -->
                        @elseif($question['status'] === 0)
                        <div class="text-center">
                            <a href="{{ route('get.answer_form', ['id' => $question['id']]) }}">
                                <button type='button' class='btn btn-secondary'>質問に回答する</button>
                            </a>
                        </div>
                        @endif
                        <div class="border pre-scrollable">
                            @foreach($question['answer'] as $answer)
                            <div>
                                <p>{{ $answer['name'] }}さん</p>
                                <p>{{ $answer['answer'] }}</p>
                                <!-- 閲覧者が質問者の場合は「返信」が可能です。この質問の回答者の場合は「編集」と、相手の返信に対する返信が可能です。どちらでもない場合は「いいね」のみできます。-->
                                @if($user['id'] === $question['questioners_id'] && $question['status'] === 0)
                                <button>返信する</button>
                                @endif
                                <!-- 返信内容 -->
                                @foreach($answer['comments'] as $comment)
                                <p>To:匿名さん</p>
                                <p>{{ $comment['renponds'] }}</p>
                                @endforeach
                            </div>
                            <hr class="style-one">
                            @endforeach
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
