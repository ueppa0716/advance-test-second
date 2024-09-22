@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="register-form">
        <h2 class="register-form__heading">会員登録</h2>
        <div class="register-form__inner">
            <form class="register-form__form" action="/register" method="post">
                @csrf
                <div class="register-form__group">
                    <p class="register-form__text">メールアドレス</p>
                    <input class="register-form__input" type="mail" name="email" id="email"
                        value="{{ old('email') }}" />
                    <p class="register-form__error-message">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <p class="register-form__text">パスワード</p>
                    <input class="register-form__input" type="password" name="password" id="password">
                    <p class="register-form__error-message">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <input class="register-form__btn" type="submit" value="登録する">
            </form>
            <div class="register-form__nav">
                <a class="register-form__nav-link" href="/login">ログインはこちら</a>
            </div>
        </div>
    </div>
@endsection('content')
