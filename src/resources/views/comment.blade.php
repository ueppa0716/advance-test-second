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
            @if (isset($commentInfos))
            @foreach ($commentInfos as $commentInfo)

            @if ($commentInfo->user_id === $itemInfo->user_id && $commentInfo->status == 1)
            <!-- 出品者の場合 -->
            <div class="comment-group__myself">
                <div class="comment-group__myInfo">
                    <!--コメント削除フォーム (statusが1のとき)  -->
                    @if (($commentInfo->user_id === $user->id || $user->authority == 0) && $commentInfo->status == 1)
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="コメント削除" name="delete">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                    @endif
                    <!--アクティブに戻す/完全削除 (statusが0のとき, authorityが0のとき) -->
                    @if ($user->authority == 0 && $commentInfo->status == 0)
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="アクティブに戻す" name="reset">
                        <input class="comment-delete__btn" type="submit" value="完全に削除" name="eliminate">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                    @endif

                    <p class="comment-group-text">{{ $commentInfo->user->name }}</p>
                    <img src="{{ $commentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                </div>
                <p class="comment-group-time">{{ $commentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $commentInfo->comment }}</p>
            </div>
            @elseif ($commentInfo->user_id !== $itemInfo->user_id && $commentInfo->status == 1)
            <!-- 出品者でない場合 -->
            <div class="comment-group__other">
                <div class="comment-group__otherInfo">
                    <img src="{{ $commentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                    <p class="comment-group-text">{{ $commentInfo->user->name }}</p>

                    <!--コメント削除フォーム (statusが1のとき)  -->
                    @if (($commentInfo->user_id === $user->id || $user->authority == 0) && $commentInfo->status == 1)
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="コメント削除" name="delete">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                    @endif

                    <!--アクティブに戻す/完全削除 (statusが0のとき, authorityが0のとき) -->
                    @if ($user->authority == 0 && $commentInfo->status == 0)
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="アクティブに戻す" name="reset">
                        <input class="comment-delete__btn" type="submit" value="完全に削除" name="eliminate">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                    @endif
                </div>
                <p class="comment-group-time">{{ $commentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $commentInfo->comment }}</p>
            </div>
            @elseif ($user->authority == 0 && $commentInfo->status == 0)
            @if ($commentInfo->user_id === $itemInfo->user_id)
            <!-- 出品者の場合 -->
            <div class="comment-group__myself">
                <div class="comment-group__myInfo">
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="アクティブに戻す" name="reset">
                        <input class="comment-delete__btn" type="submit" value="完全に削除" name="eliminate">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                    <p class="comment-group-text">{{ $commentInfo->user->name }}</p>
                    <img src="{{ $commentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                </div>
                <p class="comment-group-time">{{ $commentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $commentInfo->comment }}</p>
            </div>
            @elseif ($commentInfo->user_id !== $itemInfo->user_id)
            <!-- 出品者でない場合 -->
            <div class="comment-group__other">
                <div class="comment-group__otherInfo">
                    <img src="{{ $commentInfo->user->photo }}" alt="User Photo" class="comment-group-img">
                    <p class="comment-group-text">{{ $commentInfo->user->name }}</p>
                    <form class="" method="post" action="/comment/delete">
                        @csrf
                        <input class="comment-delete__btn" type="submit" value="アクティブに戻す" name="reset">
                        <input class="comment-delete__btn" type="submit" value="完全に削除" name="eliminate">
                        <input type="hidden" name="comment_id" value="{{ $commentInfo->id }}">
                    </form>
                </div>
                <p class="comment-group-time">{{ $commentInfo->created_at->format('Y/m/d') }}</p>
                <p class="comment-group__comment">{{ $commentInfo->comment }}</p>
            </div>
            @endif
            @endif

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