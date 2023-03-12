@extends('layouts.layout')
@section('content')

    <!-- バリデーション　-->
    <div class="panel-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <!-- バリデーションここまで　-->

    <!-- コンテンツエリア -->
    <main class="col-md-12">
            <div class="p-sm-3"></div>
            <div class="q-list-header">
                <a href="{{ route('get.my-q-a') }}">
                    <button type="button" class="btn btn-success">My Q & A</button>
                </a>
                <a href="{{ route('get.question') }}">
                    <button type="button" class="btn btn-success">質問する</button>
                </a>
            </div>
            <!-- タブ -->
            <div class="tabs">
                <input id="schedule" type="radio" name="tab_item2" checked>
                    <label class="tab_item2" for="schedule">質問一覧</label>
                <input id="test" type="radio" name="tab_item2">
                    <label class="tab_item2" for="test">未解決
                        <!-- 余裕があったらCSSに記載 -->
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-danger">2</span>
                    </label>
                <input id="channel" type="radio" name="tab_item2">
                    <label class="tab_item2" for="channel">解決済み</label>
            <!-- / タブ -->

            <!-- 質問一覧 -->
            <div class="tab_content" id="schedule_content" align="middle">
                <div class="tab_content_description">
                    <!-- 検索欄 -->
                    <div class="input-group">
                    <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力"></input>
                        <span class="input-group-btn input-group-append">
                            <submit type="submit" id="btn-search" class="btn btn-primary"><i class="fas fa-search"></i> 検索</submit>
                        </span>
                    </div>
                    <!-- 質問リスト -->
                    <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            {{-- @foreach() --}}
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#ff0000">回答受付中！</font></p>
                            </div>
                            <div>
                                <a href="{{ route('question-detail.list') }}"><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            {{-- @endforeach --}}
                            <!-- 以下サンプルなので、実装の際は削除 -->
                            <div class="question_list_header">
                                <p class="text_box_math">数学</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#ff0000">回答受付中！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <!-- / サンプル -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- 未解決 -->
            <div class="tab_content" id="test_content" align="middle">
                <div class="tab_content_description">
                <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            {{-- @foreach() --}}
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#ff0000">回答受付中！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            {{-- @endforeach --}}
                            <!-- 以下サンプルなので、実装の際は削除 -->
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#ff0000">回答受付中！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <!-- / サンプル -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- 解決済み -->
            <div class="tab_content" id="channel_content" align="middle">
                <div class="tab_content_description">
                <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            {{-- @foreach() --}}
                            <div class="question_list_header">
                                <p class="text_box_math">数学</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            {{-- @endforeach --}}
                            <!-- 以下サンプルなので、実装の際は削除 -->
                            <div class="question_list_header">
                                <p class="text_box_en">英語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <div class="question_list_header">
                                <p class="text_box_ja">国語</p><p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href=""><p>この文章はサンプルです。DB作成後は削除してください。</p></a>
                            </div>
                            <hr class="style-one">
                            <!-- / サンプル -->
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <div class="row justify-content-center">
        <a href="./">
    <button type='button' class='btn btn-secondary'>トップページへ戻る</button>
        </a>
    </div>
    <!-- / コンテンツエリア -->
@endsection
    </div>
</body>
</html>
