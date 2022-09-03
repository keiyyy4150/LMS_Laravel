@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">課題の詳細</div>
                <div class="card-body">
                    <div class="text-left">
                        <table>
                            <thead>
                            <tr>
                                <td>課題名：</td>
                                <td>{{ $assignDetails['assign_name'] }}</td>
                            </tr>
                            <tr>
                                <td>内容：</td>
                                <td>{{ $assignDetails['explanation'] }}</td>
                            </tr>
                            <tr>
                                <td>提出期限：</td>
                                <td>{{ $assignDetails['deadline'] }}</td>
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