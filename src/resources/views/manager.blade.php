@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
@endsection

@section('content')
<div class="manager">
    <div class="manager-heading">
        <h1 class="manager-heading__title">管理者ページへようこそ</h1>
        <h2 class="manager-heading__text">ユーザー 一覧</h2>
    </div>
    <table class="user__table">
        <tr class="user__row">
            <th class="user-label">ユーザー名</th>
            <th class="user-label">メールアドレス</th>
            <th class="user-label">登録日</th>
            <th class="user-label">オプション</th>
        </tr>
        @if (isset($userInfos))
        @foreach ($userInfos as $userInfo)
        <tr class="user__row">
            <th class="user-label">{!! $userInfo->name ?? '未登録' !!}</th>
            <th class="user-label">{{ $userInfo->email }}</th>
            <th class="user-label">{{ $userInfo->created_at->format('Y/m/d') }}</th>
            <th class="user-label">
                <form class="" method="post" action="/manager/user/delete">
                    @csrf
                    <input class="user-delete-btn" type="submit" value="削除する" name="delete">
                    <input type="hidden" name="user_id" value="{{ $userInfo->id }}">
                </form>
            </th>
        </tr>
        @endforeach
        @endif
    </table>
    <p class="user__delete__success-message">
        @if (session('success'))
        {{ session('success') }}
        @endif
    </p>
</div>
@endsection('content')

{{ $userInfos->appends(request()->input())->links() }}