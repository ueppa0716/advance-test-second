@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mylist.css') }}">
@endsection

@section('content')
<div class="item">
    <div class="item-heading">
        <a class="item-recommend" href="/">おすすめ</a>
        <form action="/mylist" method="get">
            @csrf
            <button type="submit" class="item-mylist" name="mylist">マイリスト</button>
        </form>
    </div>
    <div class="item-content">
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
</div>
@endsection('content')