@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <div class="purchase-detail">
        <div class="detail-item">
            <div class="detail-group-img">
                <img src="{{ $itemInfo->photo }}" alt="Item Photo" class="detail-item-img">
            </div>
            <div class="detail-group__info">
                <p class="detail-item__name">{{ $itemInfo->name }}</p>
                <p class="detail-item__price">¥{{ number_format($itemInfo->price) }}</p>
            </div>
        </div>
        <div class="detail-payment">
            <div class="detail-group__payment">
                <p class="detail-group__text">支払い方法</p>
                <form class="detail-address__form" method="post" action="/purchase/address/{{ $itemInfo->id }}">
                    @csrf
                    <input class="detail-address-btn" type="submit" value="変更する" name="change">
                    <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
                    <input type="hidden" name="payment_id" value="{{ $payments->firstWhere('id', $newInfo['payment_id']) ?? $payments->firstWhere('id', 1) }}">
                    <input type="hidden" name="post_code" value="{{ $newInfo['post_code'] ?? $user->post_code }}">
                    <input type="hidden" name="address" value="{{ $newInfo['address'] ?? $user->address }}">
                    <input type="hidden" name="building" value="{{ $newInfo['building'] ?? $user->building }}">
                </form>
            </div>
            <p class="detail-group__method">{{ $payments->firstWhere('id', $newInfo['payment_id'])->payment ?? $payments->firstWhere('id', 1)->payment }}</p>
        </div>
        <div class="detail-address">
            <div class="detail-group__address">
                <p class="detail-group__text">配送先</p>
                <form class="detail-address__form" method="post" action="/purchase/address/{{ $itemInfo->id }}">
                    @csrf
                    <input class="detail-address-btn" type="submit" value="変更する" name="change">
                    <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
                    <input type="hidden" name="payment_id" value="{{ $payments->firstWhere('id', $newInfo['payment_id']) ?? $payments->firstWhere('id', 1) }}">
                    <input type="hidden" name="post_code" value="{{ $newInfo['post_code'] ?? $user->post_code }}">
                    <input type="hidden" name="address" value="{{ $newInfo['address'] ?? $user->address }}">
                    <input type="hidden" name="building" value="{{ $newInfo['building'] ?? $user->building }}">
                </form>
            </div>
            <div class="detail-address__info">
                <table class="detail-address-table">
                    <tr class="detail-address__row">
                        <th class="detail-address__th">郵便番号</th>
                        <td class="detail-address__td"> {{ $newInfo['post_code'] ?? $user->post_code 
        ? substr($newInfo['post_code'] ?? $user->post_code, 0, 3) . '-' . substr($newInfo['post_code'] ?? $user->post_code, 3)
        : 'なし' 
    }}</td>
                    </tr>
                    <tr class="detail-address__row">
                        <th class="detail-address__th">住所</th>
                        <td class="detail-address__td">{{ $newInfo['address'] ??  $user->address }}</td>
                    </tr>
                    <tr class="detail-address__row">
                        <th class="detail-address__th">建物名</th>
                        <td class="detail-address__td">{{ $newInfo['building'] ?? $user->building ?? "なし" }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <div class="purchase-info">
        <table class="purchase-table">
            <tr class="purchase-table__row">
                <th class="purchase-table__th">商品代金</th>
                <td class="purchase-table__td">¥{{ number_format($itemInfo->price) }}</td>
            </tr>
            <tr class="purchase-table__row">
                <th class="purchase-table__th"></th>
                <td class="purchase-table__td"></td>
            </tr>
            <tr class="purchase-table__row">
                <th class="purchase-table__th">支払い金額</th>
                <td class="purchase-table__td">¥{{ number_format($itemInfo->price) }}</td>
            </tr>
            <tr class="purchase-table__row">
                <th class="purchase-table__th">支払い方法</th>
                <td class="purchase-table__td">{{ $payments->firstWhere('id', $newInfo['payment_id'])->payment ?? $payments->firstWhere('id', 1)->payment }}</td>
            </tr>
        </table>
        <form class="purchase-group" method="post" action="/purchase/confirm/{{ $itemInfo->id }}">
            @csrf
            <input class="purchase-group-btn" type="submit" value="購入内容確認ページへ" name="purchase">
            <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
            <input type="hidden" name="payment_id" value="{{ $newInfo['payment_id'] ?? $payments->firstWhere('id', 1)->id }}">
            <input type="hidden" name="post_code" value="{{ $newInfo['post_code'] ?? $user->post_code }}">
            <input type="hidden" name="address" value="{{ $newInfo['address'] ??  $user->address }}">
            <input type="hidden" name="building" value="{{ $newInfo['building'] ?? $user->building }}">
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
@endsection