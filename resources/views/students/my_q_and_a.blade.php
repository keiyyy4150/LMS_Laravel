@extends('layouts.layout')
@section('content')
<main class="col-md-12">
    <div class="row justify-content-center">
        <div class="card shadow-ch">
            <div class="card-header bg-dark text-white text-center">My Q And A</div>

            </div>
        </div>
        <div class="row justify-content-center">
            <a href="{{ url()->previous() }}">
                <button type='button' class='btn btn-secondary'>戻る</button>
            </a>
        </div>
    </div>
</main>
@endsection
    </div>
</body>
</html>
