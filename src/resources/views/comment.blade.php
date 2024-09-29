@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
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
                            <img src="{{ $otherCommentInfo->user->photo }}" alt="User Photo" class="comment-group__img">
                            <p class="comment-group__name">{{ $otherCommentInfo->user->name }}</p>
                            <p class="comment-group__comment">{{ $otherCommentInfo->comment }}</p>
                        </div>
                    @endforeach
                @endif
                @if (isset($myCommentInfos))
                    @foreach ($myCommentInfos as $myCommentInfo)
                        <div class="comment-group__other">
                            <img src="{{ $myCommentInfo->user->photo }}" alt="User Photo" class="comment-group__img">
                            <p class="comment-group__name">{{ $myCommentInfo->user->name }}</p>
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
