@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
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
                <a class="" href="/item/{{ $itemInfo->id }}s"><img class="img-comment"
                        src="https://img.icons8.com/?size=100&id=8h51YOzhBJmT&format=png&color=000000"
                        alt="コメント"></a>
                <p class="count-comment">{{ $commentCount }}</p>
            </div>
        </div>
        <div class="comment-group">
            @if (isset($otherCommentInfos))
            @foreach ($otherCommentInfos as $otherCommentInfo)
            <div class="comment-group__other">
                <div class="comment-group__otherInfo">
                    <img src="{{ $otherCommentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                    <p class="comment-group-text">{{ $otherCommentInfo->user->name }}</p>
                </div>
                <p class="comment-group-time">{{ $otherCommentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $otherCommentInfo->comment }}</p>
                <input type="hidden" name="comment_id" value="{{ $otherCommentInfo->id }}">
            </div>
            @endforeach
            @endif
            @if (isset($myCommentInfos))
            @foreach ($myCommentInfos as $myCommentInfo)
            <div class="comment-group__myself">
                <div class="comment-group__myInfo">
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="コメント削除" name="delete">
                        <input type="hidden" name="comment_id" value="{{ $myCommentInfo->id }}">
                    </form>
                    <p class="comment-group-text">{{ $myCommentInfo->user->name }}</p>
                    <img src="{{ $myCommentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                </div>
                <p class="comment-group-time">{{ $myCommentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $myCommentInfo->comment }}</p>
            </div>
            @endforeach
            @endif
        </div>
        <form class="detail-group-purchase" method="post" action="/comment/update">
            @csrf
            <label class="detail-item__text">商品へのコメント</label>
            <textarea class="detail-item__comment-area" name="comment" id="comment" rows="10">{{ old('comment') }}</textarea>
            <input class="detail-comment-btn" type="submit" value="コメントを送信する" name="review">
            <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
        </form>
        @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="error-message__text">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection('content')