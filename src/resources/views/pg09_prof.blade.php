@extends('layouts.app2')

@section('title', 'プロフィールページ') {{-- タイトルは専用セクションに分離 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg09_prof.css') }}">
@endsection

@section('content')
    <main class="profile-container">
        <section class="user-info">
            <div class="avatar"></div>
            <h2 class="username">ユーザー名</h2>
            <a href="/mypage/profile" class="edit-profile-button">プロフィールを編集</a>
        </section>

        <div class="tab-menu">
            <a href="#" class="active-tab">出品した商品</a>
            <a href="#">購入した商品</a>
        </div>

        <section class="product-list">
            <div class="product-item">
                <div class="product-image">商品画像</div>
                <p class="product-name">商品名</p>
            </div>
            <div class="product-item">
                <div class="product-image">商品画像</div>
                <p class="product-name">商品名</p>
            </div>
            <div class="product-item">
                <div class="product-image">商品画像</div>
                <p class="product-name">商品名</p>
            </div>
            <div class="product-item">
                <div class="product-image">商品画像</div>
                <p class="product-name">商品名</p>
            </div>
        </section>
    </main>
@endsection
