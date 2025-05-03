@extends('layouts.common_app1')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg01_product_list.css') }}">
@endsection

@section('content')
@php
$keyword = request('keyword');
@endphp

<div class="tabs">
    <!-- おすすめタブ -->
    <a href="{{ route('top', ['page' => 'recommend', 'keyword' => $keyword]) }}"
        class="tab {{ request('page') !== 'mylist' ? 'active' : '' }}">
        おすすめ
    </a>

    <!-- マイリストタブ -->
    <a href="{{ route('top', ['page' => 'mylist', 'keyword' => $keyword]) }}"
        class="tab {{ request('page') === 'mylist' ? 'active' : '' }}">
        マイリスト
    </a>
</div>

<main class="product-grid">
    @if (request('page') === 'mylist')
        @auth
            @forelse ($mylist as $item)
                <div class="product-card">
                    <div class="product-image">
                        <a href="{{ route('item.showdetail', ['item_id' => $item->id]) }}">
                            <img src="{{ asset('storage/product_img/' . $item->image_path) }}" alt="{{ $item->name }}">
                        </a>
                        @if ($item->is_sold)
                            <div class="sold-label">Sold</div>
                        @endif
                    </div>
                    <div class="product-name">{{ $item->name }}</div>
                </div>
            @empty
                <p>いいねした商品はありません</p>
            @endforelse
        @else
            <!-- <p class="auth-required-message">マイリストを見るには <a href="{{ route('login') }}">ログイン</a> が必要です。</p> -->
        @endauth
    @else
        @foreach ($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <a href="{{ route('item.showdetail', ['item_id' => $product->id]) }}">
                        <img src="{{ asset('storage/product_img/' . urlencode($product->image_path)) }}" alt="{{ $product->name }}">
                    </a>
                    @if ($product->is_sold)
                        <div class="sold-label">Sold</div>
                    @endif
                </div>
                <div class="product-name">{{ $product->name }}</div>
            </div>
        @endforeach
    @endif
</main>
@endsection