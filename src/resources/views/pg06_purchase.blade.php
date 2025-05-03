@extends('layouts.common_app1')

@section('title', '購入確認')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg06_purchase.css') }}">
@endsection

{{-- @if ($errors->any())
<div class="form-errors">
    <ul>
        @foreach ($errors->keys() as $field)
            @foreach ($errors->get($field) as $message)
                <li><strong>{{ $field }}:</strong> {{ $message }}</li>
            @endforeach
        @endforeach
    </ul>
</div>
@endif --}}

@section('content')
<form action="{{ route('purchase.execute', ['item_id' => $product->id]) }}" method="POST">
    @csrf

    <div class="purchase-container">
        <!-- 左側の商品情報 -->
        <section class="product-info">
            <div class="product-main">
                <div class="product-image">
                    <img src="{{ asset('storage/product_img/' . $product->image_path) }}" alt="{{ $product->name }}">
                </div>

                <div class="product-details">
                    <h1 class="product-name">{{ $product->name }}</h1>
                    <p class="product-price">￥{{ number_format($product->price) }}</p>
                </div>
            </div>

            <hr>

            <section class="payment-method">
                <h2>支払い方法　
                    @error('payment_method')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </h2>
                <div class="select-wrapper">
                    <div class="payment-select" id="payment_method">
                        <span class="selected-label selected-label--placeholder">選択してください</span>
                        <ul class="options">
                            <li data-value="コンビニ支払い">
                                <span class="check"></span>
                                <span class="label">コンビニ支払い</span>
                            </li>
                            <li data-value="カード支払い">
                                <span class="check"></span>
                                <span class="label">カード支払い</span>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="payment_method" id="payment_input">
                </div>
            </section>

            <hr>

            <section class="shipping-address">
                <div class="shipping-header">
                    <h2>配送先</h2>
                    <a href="{{ route('purchase.edit_address', ['item_id' => $product->id]) }}">変更する</a>
                </div>

                @php
                $postal_code = $tempAddress['postal_code'] ?? $profile->postal_code ?? '';
                $address     = $tempAddress['address'] ?? $profile->address ?? '';
                $building    = $tempAddress['building'] ?? $profile->building ?? '';
                @endphp

                <p>
                    〒{{ $postal_code }}<br>
                    {{ $address }} {{ $building }}
                </p>
            </section>
            <hr>
        </section>

        <!-- 右側の注文情報 -->
        <aside class="order-summary">
            <div class="summary-box">
                <p class="row-price">
                    <span class="label-price-r">商品代金</span>
                    <span class="price-value">￥{{ number_format($product->price) }}</span>
                </p>
                <p class="row-payment">
                    <span class="label-payment-r">支払い方法</span>
                    <span class="payment-value">未選択</span>
                </p>
            </div>

            <button type="submit" class="purchase-btn">購入する</button>
        </aside>
    </div>
</form>
@endsection

@section('js')
<script src="{{ asset('js/pg06_purchase.js') }}" defer></script>
@endsection
