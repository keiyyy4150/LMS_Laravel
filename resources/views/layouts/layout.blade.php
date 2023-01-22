<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '学習管理') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ajax.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/original.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div>
                    <img src="/icon.png" alt="アプリアイコン" width="50" height="50">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        MOKUMOCLUB
                    </a>
                </div>
                <div class="my-navbar-control">
                @if(Auth::check())
                    <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('info') }}">プロフィール</a>
                        <a class="dropdown-item" href="/edit_info">各種登録</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout" id="logout">ログアウト</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
</div>
                    <!--/
                    <a href="/logout" id="logout" class="my-navbar-item">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>-->
                    <script>
                        document.getElementById('logout').addEventListener('click', function(event) {
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                        });
                    </script>
                @else
                    <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
                    /
                    <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
                @endif
            </div>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
