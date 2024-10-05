@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
<div class="detail-group">
    <div class="detail-group-img">
        <img src="{{ $itemInfo->photo }}" alt="Item Photo" class="detail-item-img">
    </div>
    <div class="detail-group-item">
        <p class="detail-item__title">商品名</p>
        <p class="detail-item__name">{{ $itemInfo->name }}</p>
        <p class="detail-item__price">¥{{ number_format($itemInfo->price) }}(値段)</p>
        <div class="detail-group__user">
            <form class="detail-group__like" method="post" action="/item/like/{{ $itemInfo->id }}">
                @csrf
                <button class="img-like" type="submit" value="like" name="like">
                    @if (empty($itemInfo->liked))
                    <img class="" src="https://img.icons8.com/?size=100&id=16101&format=png&color=000000"
                        alt="お気に入り">
                    @elseif($itemInfo->liked)
                    <img class="" src="https://img.icons8.com/?size=100&id=16101&format=png&color=FCC419"
                        alt="お気に入り">
                    @endif
                </button>
                <p class="count-like">{{ $likeCount }}</p>
            </form>
            <div class="detail-group__comment">
                <a class="" href="/comment/{{ $itemInfo->id }}"><img class="img-comment"
                        src="https://img.icons8.com/?size=100&id=8h51YOzhBJmT&format=png&color=000000"
                        alt="コメント"></a>
                <p class="count-comment">{{ $commentCount }}</p>
            </div>
        </div>
        <form class="detail-group-purchase" method="get" action="/item/{{ $itemInfo->id }}">
            @csrf
            <input class="detail-purchase-btn" type="submit" value="購入する" name="purchase">
        </form>
        <p class="detail-item__title">商品説明</p>
        <p class="detail-item__detail">{{ $itemInfo->detail }}</p>
        <p class="detail-item__title">商品の情報</p>
        <ul class="detail-item__info">
            <li class="detail-item-text">カテゴリー</li>
            <li class="detail-item-category">{{ $itemInfo->category->category }}</li>
        </ul>
        <ul class="detail-item__info">
            <li class="detail-item-text">商品の状態</li>
            <li class="detail-item-condition">{{ $itemInfo->condition->condition }}</li>
        </ul>
    </div>
</div>
@endsection('content')