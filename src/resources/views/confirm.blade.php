@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
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
            </div>
            <p class="detail-group__method">{{ $payments->firstWhere('id', $purchaseInfo['payment_id'])->payment }}</p>
        </div>
        <div class="detail-address">
            <div class="detail-group__address">
                <p class="detail-group__text">配送先</p>
            </div>
            <div class="detail-address__info">
                <table class="detail-address-table">
                    <tr class="detail-address__row">
                        <th class="detail-address__th">郵便番号</th>
                        <td class="detail-address__td"> {{ substr($purchaseInfo['post_code'] , 0, 3) . '-' . substr($purchaseInfo['post_code'] , 3)}}</td>
                    </tr>
                    <tr class="detail-address__row">
                        <th class="detail-address__th">住所</th>
                        <td class="detail-address__td">{{ $purchaseInfo['address'] ??  $user->address }}</td>
                    </tr>
                    <tr class="detail-address__row">
                        <th class="detail-address__th">建物名</th>
                        <td class="detail-address__td">{{ $purchaseInfo['building'] ?? $user->building ?? "なし" }}</td>
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
                <td class="purchase-table__td">{{ $payments->firstWhere('id', $purchaseInfo['payment_id'])->payment }}</td>
            </tr>
        </table>
        @if($purchaseInfo['payment_id'] == 2)
        <form class="purchase-group" method="post" action="/purchase/charge/{{ $itemInfo->id }}">
            {{ csrf_field() }}
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-amount="{{ $itemInfo->price }}"
                data-name="クレジットカード払い"
                data-label="クレジットカード払い"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="JPY">
            </script>
            <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
            <input type="hidden" name="payment_id" value="{{ $purchaseInfo['payment_id'] }}">
            <input type="hidden" name="post_code" value="{{ $purchaseInfo['post_code'] ?? $user->post_code }}">
            <input type="hidden" name="address" value="{{ $purchaseInfo['address'] ??  $user->address }}">
            <input type="hidden" name="building" value="{{ $purchaseInfo['building'] ?? $user->building }}">
        </form>
        @else
        <form class="purchase-group" method="post" action="/purchase/complete/{{ $itemInfo->id }}">
            @csrf
            <input class="purchase-group-btn" type="submit" value="購入する" name="purchase">
            <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
            <input type="hidden" name="payment_id" value="{{ $purchaseInfo['payment_id'] }}">
            <input type="hidden" name="post_code" value="{{ $purchaseInfo['post_code'] ?? $user->post_code }}">
            <input type="hidden" name="address" value="{{ $purchaseInfo['address'] ??  $user->address }}">
            <input type="hidden" name="building" value="{{ $purchaseInfo['building'] ?? $user->building }}">
        </form>
        @endif
        <form class="purchase-group" method="get" action="/purchase/{{ $itemInfo->id }}">
            @csrf
            <input class="purchase-group__back" type="submit" value="戻る" name="back">
            <input type="hidden" name="item_id" value="{{ $itemInfo->id }}">
            <input type="hidden" name="payment_id" value="{{ $purchaseInfo['payment_id'] }}">
            <input type="hidden" name="post_code" value="{{ $purchaseInfo['post_code'] ?? $user->post_code }}">
            <input type="hidden" name="address" value="{{ $purchaseInfo['address'] ??  $user->address }}">
            <input type="hidden" name="building" value="{{ $purchaseInfo['building'] ?? $user->building }}">
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