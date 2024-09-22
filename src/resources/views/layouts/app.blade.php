<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <a class="header__heading" href="/"><img src="{{ asset('logo.svg') }}" alt="Logo"></a>
            {{-- <nav class="header__link-nav">
                <ul class="header__link-ul">
                    <li class="header__link-li"><a class="header__link-text" href="/">Home</a></li>
                    @if (Auth::check())
                        <li class="header__link-li">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="header__link-btn">Logout</button>
                            </form>
                        </li>
                        <li class="header__link-li"><a class="header__link-text" href="/mypage">Mypage</a></li>
                    @else
                        <li class="header__link-li"><a class="header__link-text" href="/register">Registration</a></li>
                        <li class="header__link-li"><a class="header__link-text" href="/login">Login</a></li>
                    @endif
                </ul>
            </nav> --}}

            @yield('header')
        </header>

        <div class="content">
            @yield('content')
        </div>


    </div>
</body>

</html>
