@extends('layouts.common_app1')

@section('title', '商品出品')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg08_product_sell.css') }}">
@endsection

@section('content')
<!-- メインコンテンツ -->
<main class="form-container">
    <h1>商品の出品</h1>
    <!-- @if ($errors->any())
    <ul class="field-error">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif -->
    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 商品画像 -->
        <section class="product-image-section">
            <label for="product-image">商品画像　
                @if ($errors->has('product-image'))
                <span class="field-error">{{ $errors->first('product-image') }}</span>
                @endif
            </label>

            <div class="image-upload" id="imageUploadArea">
                <p id="uploadText">画像を選択する</p>
                <img id="imagePreview" src="" alt="プレビュー" style="display: none;" />
            </div>
            <input type="file" name="product-image" id="product-image" class="hidden-input" accept="image/*">
        </section>

        <!-- 商品の詳細 -->
        <section class="product-details-section">
            <h2>商品の詳細</h2>

            <!-- カテゴリ -->
            <label>カテゴリー　
                @if ($errors->has('category_ids'))
                <span class="field-error">{{ $errors->first('category_ids') }}</span>
                @endif
            </label>
            <div class="categories">
                @foreach($categories as $category)
                <span class="category-tag" data-id="{{ $category->id }}">{{ $category->name }}</span>
                @endforeach
            </div>

            <!-- 選択されたカテゴリをフォーム送信用（複数可） -->
            <input type="hidden" name="category_ids" id="selectedCategories" value="{{ old('category_ids') }}">

            <!-- 商品の状態 -->
            <div class="label-with-error">
                <label for="condition">商品の状態</label>
                @if ($errors->has('condition_id'))
                <span class="field-error">{{ $errors->first('condition_id') }}</span>
                @endif
            </div>
            <!-- 商品状態 カスタムセレクト -->
            <div class="custom-select-wrapper">
                <div class="custom-select" id="customSelect">
                    <span class="selected">選択してください</span>
                    <ul class="options">
                        @foreach ($conditions as $condition)
                        <li data-id="{{ $condition->id }}" data-value="{{ $condition->label }}">{{ $condition->label }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- フォーム送信用 -->
                <input type="hidden" name="condition_id" id="conditionInput" value="{{ old('condition_id') }}">
                <!-- <p style="color: #999;">[DEBUG] condition_id: {{ old('condition_id') }}</p> -->
                <!-- <input type="hidden" name="condition_id" id="conditionInput" value="{{ old('condition_id') }}">
                <p>[DEBUG hidden] <code>conditionInput.value = "{{ old('condition_id') }}"</code></p> -->
            </div>
        </section>

        <!-- 商品名と説明 -->
        <section class="product-description-section">
            <h2 class="sub-label">商品名と説明</h2>

            <label for="product-name">商品名　
                @if ($errors->has('product_name'))
                <span class="field-error">{{ $errors->first('product_name') }}</span>
                @endif
            </label>
            <input type="text" id="product-name" name="product_name" value="{{ old('product_name') }}">

            <label for="brand">ブランド名　
                @if ($errors->has('brand'))
                <span class="field-error">{{ $errors->first('brand') }}</span>
                @endif
            </label>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}">

            <label for="product-description">商品の説明　
                @if ($errors->has('product_description'))
                <span class="field-error">{{ $errors->first('product_description') }}</span>
                @endif
            </label>
            <textarea id="product-description" name="product_description">{{ old('product_description') }}</textarea>
        </section>

        <!-- 販売価格 -->
        <section class="product-price-section">
            <label for="price">販売価格　
                @if ($errors->has('price'))
                <span class="field-error">{{ $errors->first('price') }}</span>
                @endif
            </label>
            <!-- 修正後（\ はCSSで表示） -->
            <div class="price-input">
                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="&yen;">
            </div>
        </section>

        <button class="submit-btn" type="submit">出品する</button>
    </form>
</main>
@endsection

@section('js')
<script src="{{ asset('js/pg08_product_sell.js') }}"></script>
@endsection