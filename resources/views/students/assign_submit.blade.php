@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">課題の提出</div>
                <div class="card-body">
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
                <form action="{{ route('assign.submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type='hidden' name='assigned_id' value="{{ $assignList['id'] }}"/>
                    <label for='submit_file'>提出ファイル</label>
                        <input type='file' name='submit_file' value=""/>
                    <button type='submit' class='btn btn-secondary'>提出</button>
                </form>
            <div class="tab_content" id="schedule_content">
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
    </div>
</body>
</html>