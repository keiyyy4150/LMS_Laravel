@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">プロフィール</div>
                <div class="card-body">
                    <div class="text-left">
                        <table>
                        プロフィール画像
                        @if ($user->images === null)
                        <image class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" with="70" height="70">
                        @else
                        <image class="rounded-circle" src="{{ Storage::url($user->images) }}" alt="プロフィール画像" with="70" height="70">
                        @endif
                            <thead>
                            <tr>
                                <td>お名前：</td>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                            <tr>
                                <td>フリガナ：</td>
                                <td>{{ $user['kana'] }}</td>
                            </tr>
                            <tr>
                                <td>電話番号：</td>
                                <td>{{ $user['tel'] }}</td>
                            </tr>
                            <tr>
                                <td>メールアドレス：</td>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <td>コース：</td>
                                @if(isset($course))
                                <td>{{ $course['course_name'] }}</td>
                                @else
                                <td>コースは登録されていません</td>
                                @endif
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type='button' class='btn btn-secondary' onClick='history.back()'>戻る</button>
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