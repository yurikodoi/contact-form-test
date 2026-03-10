<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <title>FashionablyLate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}?v={{ time() }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="/" class="header__logo">FashionablyLate</a>
            
            {{-- 会員登録(register)画面の時だけ右上に表示 --}}
            @if(Request::is('register'))
                <a href="/login" class="header__link-login">login</a>
            @endif
            
            <nav class="header__nav">
            {{-- Login画面の時は register ボタンを表示 --}}
            @if (Request::is('login'))
                <a href="/register" class="header__nav-button">register</a>
            @endif

                {{-- 3. 管理画面の時：logoutボタンを表示 --}}
            @auth
            @if(Request::is('admin*'))
            <a href="{{ route('logout') }}" class="header__nav-button" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
            @endauth
        </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

