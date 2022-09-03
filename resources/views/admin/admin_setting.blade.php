@extends('layouts.layout')
@section('content')
<main class="col-md-11">
    <div class="conteiner">
        <a href="./admin_manage_students">
           <button type='button' class='btn btn-danger'>生徒管理画面に切り替える</button>
        </a>
    </div>
    <div class="conteiner">
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
        <div class="card shadow">
            <div class="border">
                <h4>【トップ画面お知らせ】</h>
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr><th>現在公開中のお知らせ</th></tr>
                    </thead>
                    @if($notice->notice === null)
                    <tbody>
                        <tr><td><button type='button' class='btn btn-primary'>登録する</button></td></tr>
                    </tbody>
                    @else
                    <tbody>
                        <tr><td>{{ $notice['notice'] }}</td></tr>
                    </tbody>
                </table>
                    <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#update_setting{{ $notice['id'] }}">編集</button>
                    <!-- 以下モーダル -->
                    <div class="modal" id="update_setting{{ $notice['id'] }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('update.notice', ['setting' => $notice['id']]) }}" method="post">
                                    @csrf
                                    <p>トップページお知らせ内容<span class="badge badge-danger">必須</span></p>
                                        <textarea class='form-control' name='notice' type="text"></textarea>
                            <div class='row justify-content-center'>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- モーダルここまで -->
                @endif
            </div>
        </div>
    </div>
    <div class="conteiner">
        <div class="card shadow">
            <div class="border">
                <h4>【課題作成】</h>
                <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-example2">新規作成</button>
                <div class="modal" id="modal-example2" tabindex="-1">
                    <div class="modal-dialog">
                    <!-- 以下モーダル -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('create.assign') }}" method="post">
                                @csrf
                                <label for='assign_name'>課題名<span class="badge badge-danger">必須</span></label>
                                    <input type='text' class='form-control' name='assign_name' value=""/>
                                <label for='explanation'>内容<span class="badge badge-danger">必須</span></label>
                                    <textarea class='form-control' name='explanation' type="text"></textarea>
                                <label for='deadline'>期限<span class="badge badge-danger">必須</span></label>
                                    <input type='datetime-local' class='form-control' name='deadline' value=""/>
                                <label for='course_id'>公開範囲<span class="badge badge-danger">必須</span></label>
                                <select name='course_id' class='form-control'>
                                    <option value='' hidden>公開範囲<span class="badge badge-danger">必須</span></option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['course_name'] }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </form>
                    </div>
                </div>
                </div>
                <!-- モーダルここまで -->
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr>
                            <th>課題名</th>
                            <th>内容</th>
                            <th>期限</th>
                            <th>公開状況</th>
                            <th>公開範囲</th>
                            <th>公開設定</th>
                            <th>設定</th>
                        </tr>
                    </thead>
                    <tbody>@foreach($assignDetails as $assignDetail)
                        <tr>
                            <td>{{ $assignDetail['assign_name'] }}</td>
                            <td>{{ $assignDetail['explanation'] }}</td>
                            <td>{{ $assignDetail['deadline'] }}</td>
                            <td>@if($assignDetail['private_flg'] === 0)
                                <p>非公開</p>
                                @elseif($assignDetail['private_flg'] === 1)
                                <p>公開中</P>
                                @endif
                            </td>
                            <td>{{ $assignDetail['course']['course_name'] }}</td>
                            <td>@if($assignDetail['private_flg'] === 0)
                                <a href="{{ route('open.assignment', ['assignment' => $assignDetail['id']]) }}">
                                    <button type='button' class='btn btn-danger'>公開</button>
                                </a>
                                @elseif($assignDetail['private_flg'] === 1)
                                <a href="{{ route('close.assignment', ['assignment' => $assignDetail['id']]) }}">
                                <button type='button' class='btn btn-secondary'>非公開</button>
                                </a>
                                @endif
                            </td>
                            <td><a href="" data-toggle="modal" data-target="#update_assignment{{ $assignDetail['id'] }}">編集</a>・<a href="{{ route('delete.assignment', ['assignment' => $assignDetail['id']]) }}">削除</a></td></tr>
                            <!-- 以下モーダル -->
                            <div class="modal" id="update_assignment{{ $assignDetail['id'] }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ route('update.assignment', ['assignment' => $assignDetail['id']]) }}" method="post">
                                        @csrf
                                        <label for='assign_name'>課題名<span class="badge badge-danger">必須</span></label>
                                            <input type='text' class='form-control' name='assign_name' value="{{ $assignDetail['assign_name'] }}" />
                                        <label for='explanation'>内容<span class="badge badge-danger">必須</span></label>
                                            <textarea class='form-control' name='explanation' type="text" value="{{ $assignDetail['explanation'] }}"></textarea>
                                        <label for='deadline'>期限<span class="badge badge-danger">必須</span></label>
                                            <input type='datetime-local' class='form-control' name='deadline' value="{{ $assignDetail['deadline'] }}"/>
                                        <label for='course_id'>公開範囲<span class="badge badge-danger">必須</span></label>
                                        <select name='course_id' class='form-control'>
                                            <option value='' hidden>公開範囲<span class="badge badge-danger">必須</span></option>
                                            @foreach($courses as $course)
                                            <option value="{{ $course['id'] }}">{{ $course['course_name'] }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- モーダルここまで -->
                    </tbody>@endforeach
                </table>
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
