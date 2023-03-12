@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">質問の詳細</div>
                <div class="card text-left">
                    <div class="card-body card-img-top left_space pre-scrollable">
                    <p><font color="#ff0000">回答受付中！</font></p>
                        <div class="border">
                            <p>質問者さん</p>
                            <p>ここは質問欄です。</p>
                            <p>文章や画像が載る想定</p>
                        </div>
                        {{-- @if(ログインユーザーが質問者であれば) --}}
                        <div class="text-center">
                            <button type='button' class='btn btn-danger'>クローズする</button>
                        </div>
                        {{-- @else ログインユーザーが回答者であれば --}}
                        <div class="text-center">
                            <button type='button' class='btn btn-secondary'>質問に回答する</button>
                        </div>
                        {{-- @endif --}}
                        <div class="border pre-scrollable">
                            {{-- @foreach() --}}
                            <div>
                                <p>匿名さん</p>
                                <p>こんにちは。この回答はサンプルです。回答者の解答が全て表示され、いいねや返信も可能になります。返信に対しさらに返信することも可能にし、文章を編集、削除する機能もつける予定です。閲覧者が質問者の場合は「返信」が可能です。この質問の回答者の場合は「編集」と、相手の返信に対する返信が可能です。どちらでもない場合は「いいね」のみできます</p>
                                <button>返信する</button><!-- 閲覧者が質問者の場合は「返信」が可能です。この質問の回答者の場合は「編集」と、相手の返信に対する返信が可能です。どちらでもない場合は「いいね」のみできます。-->
                                <!-- 返信内容 -->
                                <p>To:匿名さん</p>
                                <p>ありがとうございます！</p>
                            </div>
                            <hr class="style-one">
                            {{-- @endforeach --}}
                            <div>
                                <p>匿名２さん</p>
                                <p>こんにちは。この回答はサンプルです。回答者の解答が全て表示され、いいねや返信も可能になります。返信に対しさらに返信することも可能にし、文章を編集、削除する機能もつける予定です。閲覧者が質問者の場合は「返信」が可能です。この質問の回答者の場合は「編集」と、相手の返信に対する返信が可能です。どちらでもない場合は「いいね」のみできます</p>
                                <button>返信する</button>
                            </div>
                            <hr class="style-one">
                            <div>
                                <p>匿名３さん</p>
                                <p>こんにちは。この回答はサンプルです。回答者の解答が全て表示され、いいねや返信も可能になります。返信に対しさらに返信することも可能にし、文章を編集、削除する機能もつける予定です。閲覧者が質問者の場合は「返信」が可能です。この質問の回答者の場合は「編集」と、相手の返信に対する返信が可能です。どちらでもない場合は「いいね」のみできます</p>
                                <button>返信する</button>
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
