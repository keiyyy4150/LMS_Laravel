@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    @foreach($assignLists as $assignList)
    <div class="row justify-content-center">  
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">提出期間中の課題</div>
                <div class="card-body">
                    <div class="text-center">
                        <div>
                            <a href="{{ route('assign.detail', ['assignment' => $assignList['id']]) }}">{{ $assignList['assign_name'] }}</a>
                        </div>
                            
                            <!--<div role="alert" class="alert alert-danger">未提出</div>
                           
                            <div role="alert" class="alert alert-success">提出済</div>-->
                        
                        <div>
                            <a href="{{ route('assign.form', ['assignment' => $assignList['id']]) }}">
                            <button type='button' class='btn btn-secondary'>課題を提出する</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if(!isset($assignList))
    <div class="row justify-content-center">  
    <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">提出期間中の課題</div>
                <div class="card-body">
                    <div class="text-center">
                        <div>
                             <h4>{{ $message }}</h>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <a href="./">
    <button type='button' class='btn btn-secondary'>トップページへ戻る</button>
        </a>
    </div>
</main>
@endsection
    </div>
</body>
</html>