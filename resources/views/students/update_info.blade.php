@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="card mt-5">
                    <div class="card-header">各種登録</div>
                        <div class="card-body">
                        <form action="{{ route('update.info', ['user' => $user['id']]) }}" method="POST" enctype="multipart/form-data">
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
                            @csrf
                            <div class="form-group">
                                <input type='hidden' name='id' value="{{ $user['id'] }}"/>
                            </div>
                            <div class="form-group">
                                <label for="images"></label>
                                    @if ($user->images === null)
                                    <image class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" with="100" height="100">
                                    @else
                                    <image class="rounded-circle" src="{{ Storage::url($user->images) }}" alt="プロフィール画像" with="100" height="100">
                                    @endif
                                <input id="images" name="images" type="file" class="form-control"  value="{{ $user['images'] }}" accept="image/png, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="test_date">志望校の試験日を登録しよう！</label>
                                <input type="date" class="form-control" id="test_date" name="test_date" value="{{ $user['test_date'] }}" />
                            </div>
                            <div class="form-group">
                                <label for="course_id">受験コース登録</label>
                                <select name='course_id' class='form-control'>
                                    <option value="" hidden>コースを選択してください</option>
                                    @foreach($courses as $course)
                                        @if ($course->id === null)
                                        <option value="" hidden></option>
                                        @else
                                        <option value="{{ $course['id']}}">{{ $course['course_name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right">
                                <button type='button' class='btn btn-secondary' onClick='history.back()'>戻る</button>
                                <button type="submit" class="btn btn-primary">登録する</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
