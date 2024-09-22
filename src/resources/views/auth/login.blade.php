@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="login-form">
        <h2 class="login-form__heading">ログイン</h2>
        <div class="login-form__inner">
            <form class="login-form__form" action="/login" method="post">
                @csrf
                <div class="login-form__group">
                    <p class="login-form__text">メールアドレス</p>
                    <input class="login-form__input" type="mail" name="email" id="email"
                        value="{{ old('email') }}" />
                    <p class="login-form__error-message">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="login-form__group">
                    <p class="login-form__text">パスワード</p>
                    <input class="login-form__input" type="password" name="password" id="password">
                    <p class="login-form__error-message">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <input class="login-form__btn" type="submit" value="ログインする">
            </form>
            <div class="login-form__nav">
                <a class="login-form__nav-link" href="/register">会員登録はこちら</a>
            </div>
        </div>
    </div>
@endsection('content')
