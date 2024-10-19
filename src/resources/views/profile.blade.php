@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-form">
    <h2 class="profile-form__heading">プロフィール設定</h2>
    <p class="profile-form__heading__text">※項目は入力が必須です</p>
    <div class="profile-form__inner">
        <form class="profile-form__form" action="/mypage/profile/update" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profile__info">
                @if ($user->photo)
                <img src="{{ asset($user->photo) }}" alt="User Photo" class="profile__info-img">
                @else
                <span class="profile__info-img">User Photo</span>
                @endif
                <div class="profile__btn">
                    <label for="photo">画像を選択する(※)</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>
            </div>
            <div class="profile-form__group">
                <p class="profile-form__text">ユーザー名(※)</p>
                <input class="profile-form__input" type="name" name="name" id="name"
                    value="{{ $user->name ?? old('name') }}" />
                <p class="profile-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-form__group">
                <p class="profile-form__text">郵便番号(ハイフンなし)(※)</p>
                <input class="profile-form__input" type="" name="post_code" id="post_code"
                    value="{{ $user->post_code ?? old('post_code') }}">
                <p class="profile-form__error-message">
                    @error('post_code')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-form__group">
                <p class="profile-form__text">住所(※)</p>
                <input class="profile-form__input" type="" name="address" id="address"
                    value="{{ $user->address ?? old('address') }}">
                <p class="profile-form__error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-form__group">
                <p class="profile-form__text">建物名</p>
                <input class="profile-form__input" type="" name="building" id="building"
                    value="{{ $user->building ?? old('building') }}">
            </div>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input class="profile-form__btn" type="submit" value="更新する">
        </form>
        <p class="profile__update__success-message">
            @if (session('success'))
            {{ session('success') }}
            @endif
        </p>
    </div>
</div>
@endsection