@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypageSell.css') }}">
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
        <li class="header__link-li"><a class="header__link-text" href="/mypage/sell">マイページ</a></li>
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
<div class="mypage">
    <div class="mypage-profile">
        <div class="mypage-profile__info">
            @if ($user->photo)
            <img src="{{ $user->photo }}" alt="User Photo" class="profile__info-img">
            @else
            <span class="profile__info-img">User Photo</span>
            @endif
            <p class="profile__info-name">{!! $user->name ?? '※プロフィールより、<br>&nbsp;&nbsp;&nbsp;ユーザー名を入力してください' !!}</p>
        </div>
        <div class="mypage-profile__update">
            <span class="profile__update-btn"><a class="profile__update-text" href="/mypage/profile">プロフィールを編集</a></span>
        </div>
    </div>
    <div class="mypage-item">
        <div class="mypage-item-heading">
            <a class="mypage-item__sell" href="/mypage/sell">出品した商品</a>
            <form action="/mypage/purchase" method="get">
                @csrf
                <button type="submit" class="mypage-item__purchase" name="purchase">購入した商品</button>
            </form>
        </div>
        <div class="mypage-item__info">
            @if (isset($itemInfos))
            @foreach ($itemInfos as $itemInfo)
            <div class="item-group">
                <a href="/item/{{ $itemInfo->id }}" class="detail-btn"><img src="{{ $itemInfo->photo }}"
                        alt="" class="item-img"></a>
                <ul class="item-group__info">
                    <li class="item-group-text">{{ $itemInfo->name }}</li>
                    <li class="item-group-text">¥{{ number_format($itemInfo->price) }}</li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection