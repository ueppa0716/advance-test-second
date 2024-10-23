@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

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
        @if (empty($itemInfo->purchased))
        <span class="detail-purchase-btn"><a class="detail-purchase__text"
                href="/purchase/{{ $itemInfo->id }}">購入する</a></span>
        @endif
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