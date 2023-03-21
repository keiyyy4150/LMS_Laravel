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
                        @if($unsolved_questions)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-danger">{{ $number_of_unsolved_questions }}</span>
                        @endif
                    </label>
                <input id="channel" type="radio" name="tab_item2">
                    <label class="tab_item2" for="channel">解決済み</label>
            <!-- / タブ -->

            <!-- 質問一覧 -->
            <div class="tab_content" id="schedule_content" align="middle">
                <div class="tab_content_description">
                    <!-- 検索欄 -->
                    <div class="input-group">
                    <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力" disabled></input>
                        <span class="input-group-btn input-group-append">
                            <submit type="submit" id="btn-search" class="btn btn-primary"><i class="fas fa-search"></i> 検索</submit>
                        </span>
                    </div>
                    <!-- 質問リスト -->
                    <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            @foreach($questions as $question)
                            <div class="question_list_header">
                                @if($question['subject'] == 0)
                                <p class="text_box_en">{{ $subjects[0] }}</p>
                                @elseif($question['subject'] == 1)
                                <p class="text_box_ja">{{ $subjects[1] }}</p>
                                @elseif($question['subject'] == 2)
                                <p class="text_box_math">{{ $subjects[2] }}</p>
                                @else
                                <p class="text_box_ja">{{ $subjects[$question['subject']] }}</p>
                                @endif

                                @if($question['status'] === 0)
                                <p><font color="#ff0000">回答受付中！</font></p>
                                @elseif($question['status'] === 1)
                                <p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                                @elseif($question['status'] === 2)
                                <p><font color="#ff0000">この質問は回答者の意向で凍結されました。</font></p>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('question-detail.list', ['id' => $question['id']]) }}"><p>{{ $question['title'] }}</p></a>
                            </div>
                            <p>{{ $question['created_at'] }} | 回答数：{{ $question['number_of_answers'] }}</p>
                            <hr class="style-one">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- 未解決 -->
            <div class="tab_content" id="test_content" align="middle">
                <div class="tab_content_description">
                <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            @foreach($unsolved_questions as $unsolved_question)
                            <div class="question_list_header">
                                @if($unsolved_question['subject'] == 0)
                                <p class="text_box_en">{{ $subjects[0] }}</p>
                                @elseif($unsolved_question['subject'] == 1)
                                <p class="text_box_ja">{{ $subjects[1] }}</p>
                                @elseif($unsolved_question['subject'] == 2)
                                <p class="text_box_math">{{ $subjects[2] }}</p>
                                @else
                                <p class="text_box_ja">{{ $subjects[$unsolved_question['subject']] }}</p>
                                @endif
                                <p><font color="#ff0000">回答受付中！</font></p>
                            </div>
                            <div>
                                <a href="{{ route('question-detail.list', ['id' => $unsolved_question['id']]) }}"><p>{{ $unsolved_question['title'] }}</p></a>
                            </div>
                            <p>{{ $unsolved_question['created_at'] }} | 回答数：-</p>
                            <hr class="style-one">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- 解決済み -->
            <div class="tab_content" id="channel_content" align="middle">
                <div class="tab_content_description">
                <div class="card text-left">
                        <div class="card-body left_space pre-scrollable">
                            @foreach($resolved_questions as $resolved_question)
                            <div class="question_list_header">
                                @if($resolved_question['subject'] == 0)
                                <p class="text_box_en">{{ $subjects[0] }}</p>
                                @elseif($resolved_question['subject'] == 1)
                                <p class="text_box_ja">{{ $subjects[1] }}</p>
                                @elseif($resolved_question['subject'] == 2)
                                <p class="text_box_math">{{ $subjects[2] }}</p>
                                @else
                                <p class="text_box_ja">{{ $subjects[$resolved_question['subject']] }}</p>
                                @endif
                                <p><font color="#008000">この質問は解決しました！ ご協力ありがとうございました！</font></p>
                            </div>
                            <div>
                                <a href="{{ route('question-detail.list', ['id' => $resolved_question['id']]) }}"><p>{{ $resolved_question['title'] }}</p></a>
                            </div>
                            <p>{{ $resolved_question['created_at'] }} | 回答数：-</p>
                            <hr class="style-one">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- / 質問一覧 -->
    </main>
    <div class="row justify-content-center">
        <a href="{{ route('students-home-get') }}">
    <button type='button' class='btn btn-secondary'>トップページへ戻る</button>
        </a>
    </div>
    <!-- / コンテンツエリア -->
@endsection
    </div>
</body>
</html>
