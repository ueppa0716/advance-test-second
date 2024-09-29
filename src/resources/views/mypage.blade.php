@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('header')
    <form class="search-form" action="/" method="get">
        <input class="search-form__keyword" type="text" name="keyword" placeholder="&nbsp;なにをお探しですか?"
            value="{{ request('keyword') }}">
        <input class="search-form-btn" type="submit" value="検索">
    </form>
    <nav class="header__link-nav--first">
        @if (Auth::check())
            <ul class="header__link-ul">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="header__link-text">ログアウト</button>
                </form>
            </ul>
        @else
            <ul class="header__link-ul">
                <li class="header__link-li"><a class="header__link-text" href="/login">ログイン</a></li>
            </ul>
        @endif
    </nav>
    <nav class="header__link-nav--second">
        @if (Auth::check())
            <ul class="header__link-ul">
                <li class="header__link-li"><a class="header__link-text" href="/mypage">マイページ</a></li>
            </ul>
        @else
            <ul class="header__link-ul">
                <li class="header__link-li"><a class="header__link-text" href="/register">会員登録</a></li>
            </ul>
        @endif
    </nav>
    <nav class="header__link-nav--third">
        <ul class="header__link-ul">
            <li class="header__link-li"><a class="header__link-btn" href="/sell">出品</a></li>
        </ul>
    </nav>
@endsection('header')

@section('content')
@endsection
