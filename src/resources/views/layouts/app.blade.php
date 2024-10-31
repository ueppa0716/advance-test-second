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
            <form class="search-form" action="/" method="get">
                <input class="search-form__keyword" type="text" name="keyword" placeholder="&nbsp;なにをお探しですか?"
                    value="{{ request('keyword') }}">
                <input class="search-form-btn" type="submit" value="検索">
            </form>
            <nav class="header__link-nav--first">
                @if (Auth::check())
                <!-- ログイン状態 -->
                <ul class="header__link-ul">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="header__link-text">ログアウト</button>
                    </form>
                </ul>
                @else
                <!-- 未ログイン -->
                <ul class="header__link-ul">
                    <li class="header__link-li"><a class="header__link-text" href="/login">ログイン</a></li>
                </ul>
                @endif
            </nav>
            <nav class="header__link-nav--second">
                @if (Auth::check())
                @if (isset($user) && $user->authority == 0)
                <!-- 管理者 -->
                <ul class="header__link-ul">
                    <li class="header__link-li"><a class="header__link-text" href="/manager">管理者ページ</a></li>
                </ul>
                @else
                <!-- 会員 -->
                <ul class="header__link-ul">
                    <li class="header__link-li"><a class="header__link-text" href="/mypage/sell">マイページ</a></li>
                </ul>
                @endif
                @else
                <!-- 未ログイン -->
                <ul class="header__link-ul">
                    <li class="header__link-li"><a class="header__link-text" href="/register">会員登録</a></li>
                </ul>
                @endif
            </nav>
            <nav class="header__link-nav--third">
                <ul class="header__link-ul">
                    @if (isset($user) && $user->authority == 0)
                    <!-- 管理者 -->
                    <li class="header__link-li"><a class="header__link-btn" href="/manager/mail">メール</a></li>
                    @elseif (isset($user) && $user->authority == 1)
                    <!-- 会員 -->
                    <li class="header__link-li"><a class="header__link-btn" href="/sell">出品</a></li>
                    @endif
                </ul>
            </nav>
        </header>

        <div class="content">
            @yield('content')
        </div>


    </div>
</body>

</html>