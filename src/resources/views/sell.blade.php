@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-form">
    <h2 class="sell-form__heading">商品の出品</h2>
    <div class="sell-form__inner">
        <form class="sell-form__form" action="/sell/update" method="post" enctype="multipart/form-data">
            @csrf
            <p class="sell-form__text">商品画像</p>
            <p class="sell-form__error-message">
                @error('photo')
                {{ $message }}
                @enderror
            </p>
            <div class="sell__info">
                <div class="sell__btn">
                    <label for="photo">画像を選択する(※jpg, jpeg, png, gif形式、2MB以下)</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>
            </div>
            <div class="sell-form__group">
                <p class="sell-form__title">商品の詳細</p>
                <p class="sell-form__text">カテゴリー</p>
                <select class="sell-form-select" name="category">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                    @endforeach
                </select>
                <p class="sell-form__error-message">
                    @error('category')
                    {{ $message }}
                    @enderror
                </p>
                <p class="sell-form__text">商品の状態</p>
                <select class="sell-form-select" name="condition">
                    <option value="">選択してください</option>
                    @foreach ($conditions as $condition)
                    <option value="{{ $condition->id }}"
                        {{ request('condition') == $condition->id ? 'selected' : '' }}>
                        {{ $condition->condition }}
                    </option>
                    @endforeach
                </select>
                <p class="sell-form__error-message">
                    @error('condition')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="sell-form__group">
                <p class="sell-form__title">商品名と説明</p>
                <p class="sell-form__text">商品名</p>
                <p class="sell-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
                <input class="sell-form__input" type="name" name="name" id="name"
                    value="{{ old('name') }}" />
                <p class="sell-form__text">商品の説明</p>
                <p class="sell-form__error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </p>
                <textarea class="sell-form__detail-area" name="detail" id="detail" rows="10">{{ old('detail') }}</textarea>
            </div>
            <div class="sell-form__group">
                <p class="sell-form__title">販売価格</p>
                <p class="sell-form__text">販売価格</p>
                <p class="sell-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
                <input class="sell-form__input" type="" name="price" id="price"
                    value="{{ old('price') }}" placeholder="¥">
            </div>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input class="sell-form__btn" type="submit" value="出品する">
        </form>
        <p class="sell__update__success-message">
            @if (session('success'))
            {{ session('success') }}
            @endif
        </p>
    </div>
</div>
@endsection