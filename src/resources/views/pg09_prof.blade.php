@extends('layouts.common_app1')

@section('title', 'プロフィールページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg09_prof.css') }}">
@endsection

@section('content')
<main class="profile-container">
    <section class="user-info">
        <div class="avatar-area">
            <div class="avatar">
                @php
                $profile = Auth::check() ? Auth::user()->prof : null;
                @endphp

                @if ($profile && $profile->avatar)
                <img src="{{ asset('storage/avatars/' . $profile->avatar) }}" alt="ユーザーアイコン" class="avatar-img">
                @else
                <div class="avatar-placeholder"></div>
                @endif
            </div>
            <h2 class="username">{{ $user->name }}</h2>
        </div>
        <a href="/mypage/profile" class="edit-profile-button">プロフィールを編集</a>
    </section>

    <div class="tab-menu">
        <a href="{{ route('mypage') }}?page=sell" class="{{ request('page') !== 'buy' ? 'active-tab' : '' }}">出品した商品</a>
        <a href="{{ route('mypage') }}?page=buy" class="{{ request('page') === 'buy' ? 'active-tab' : '' }}">購入した商品</a>
    </div>

    <section class="product-list">
        @foreach ($products as $product)
        <div class="product-card">
            <div class="product-image">
                @if (request('page') !== 'buy')
                <a href="{{ route('item.showdetail', ['item_id' => $product->id]) }}">
                    <img src="{{ asset('storage/product_img/' . urlencode($product->image_path)) }}" alt="{{ $product->name }}" class="product-img">
                </a>
                @else
                <img src="{{ asset('storage/product_img/' . urlencode($product->image_path)) }}" alt="{{ $product->name }}" class="product-img">
                @endif

                @if ($product->is_sold)
                <div class="sold-label">Sold</div>
                @endif
            </div>
            <div class="product-name">{{ $product->name }}</div>
        </div>
        @endforeach
    </section>
</main>
@endsection