@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypagePurchase.css') }}">
@endsection

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
        <p class="profile__update__success-message">
            @if (session('success'))
            {{ session('success') }}
            @endif
        </p>
        @if (session('error'))
        <div class="profile__update__error-message">
            {{ session('error') }}
        </div>
        @endif
    </div>
</div>
@endsection