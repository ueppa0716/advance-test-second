@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address-form">
    <h2 class="address-form__heading">住所および支払い方法の変更</h2>
    <div class="address-form__inner">
        <form class="address-form__form" action="/purchase/{{ $itemInfo->id }}" method="get">
            @csrf
            <div class="address-form__group">
                <p class="address-form__text">郵便番号(ハイフンなし)</p>
                <input class="address-form__input" type="" name="post_code" id="post_code"
                    value="{{ $userInfo['post_code'] ?? old('post_code') }}" />
                <p class="address-form__error-message">
                    @error('post_code')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="address-form__group">
                <p class="address-form__text">住所</p>
                <input class="address-form__input" type="" name="address" id="address" value="{{ $userInfo['address'] ?? old('address') }}">
                <p class="address-form__error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="address-form__group">
                <p class="address-form__text">建物名</p>
                <input class="address-form__input" type="" name="building" id="building" value="{{ $userInfo['building'] ?? old('building') }}">
                <p class="address-form__error-message">
                    @error('building')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="address-form__group">
                <p class="address-form__text">支払い方法</p>
                <select class="detail-group__method" name="payment_id">
                    @foreach ($payments as $payment)
                    <option value="{{ $payment->id }}"
                        {{ (request('payment') == $payment->id || $userInfo['payment_id'] == $payment->id) ? 'selected' : '' }}>
                        {{ $payment->payment }}
                    </option>
                    @endforeach
                </select>
                <p class="address-form__error-message">
                    @error('payment')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="address-form__btn" type="submit" value="更新する">
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