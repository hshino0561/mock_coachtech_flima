@extends('layouts.common_app1')

@section('title', '商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg05_product_detail.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <div class="product-image">
        <img src="{{ asset('storage/product_img/' . $product->image_path) }}" alt="{{ $product->name }}">

        @if ($product->is_sold)
        <div class="sold-label">Sold</div>
        @endif
    </div>

    <div class="product-info">
        <h1>{{ $product->name }}</h1>
        <p class="brand">{{ $product->brand ?? 'ブランド不明' }}</p>
        <p class="price">&yen;{{ number_format($product->price) }} <span>(税込)</span></p>

        <div class="product-actions">
            <span class="icon-stack">
                <div class="like-icon-wrapper">
                    @auth
                    <form method="POST" action="{{ route('item.like.toggle', $product->id) }}">
                        @csrf
                        <button type="submit" class="like-btn" title="いいね">
                            <img
                                src="{{ asset($product->likes->contains('user_id', auth()->id()) 
                                    ? 'storage/img/星アイコン_like_on.png' 
                                    : 'storage/img/星アイコン.png') }}"
                                alt="いいね"
                                class="icon">
                        </button>
                    </form>
                    @else
                    <img
                        src="{{ asset('storage/img/星アイコン.png') }}"
                        alt="いいね（未ログイン）"
                        class="icon"
                        style="cursor: not-allowed;">
                    @endauth
                </div>
                <span class="icon-label">{{ $product->likes->count() }}</span>
            </span>

            <span class="icon-stack">
                <img src="{{ asset('storage/img/ふきだしアイコン.png') }}" alt="コメントアイコン" class="icon">
                <span class="icon-label">{{ $product->comments->count() }}</span>
            </span>
        </div>

        {{-- 購入手続きボタン --}}
        @php
        $isOwnProduct = auth()->check() && $product->user_id === auth()->id();
        $isSold = $product->is_sold;
        $isDisabled = $isOwnProduct || $isSold || auth()->guest();
        @endphp

        <a href="{{ $isDisabled ? '#' : route('purchase.show', ['item_id' => $product->id]) }}"
            class="buy-btn full-width"
            @if($isDisabled) onclick="return false;" style="cursor: not-allowed;" @endif>
            購入手続きへ
        </a>

        <section class="product-description">
            <h2>商品説明</h2>
            <p>{!! nl2br(e($product->description)) !!}</p>
        </section>

        <section class="product-details">
            <h2>商品の情報</h2>
            <p><strong>カテゴリー</strong>
                @forelse ($product->categories as $category)
                <span class="tag">{{ $category->name }}</span>
                @empty
                <span>未分類</span>
                @endforelse
            </p>
            <p><strong>商品の状態　</strong> <span class="product-condition-value">{{ $product->condition->label ?? '不明' }}</span></p>
        </section>

        <section class="comments">
            <h2 class="comment-title">
                コメント{{ $product->comments->count() > 0 ? '(' . $product->comments->count() . ')' : '' }}
            </h2>

            @if ($product->comments->count() > 0)
            @foreach ($product->comments as $comment)
            <div class="comment">
                <div class="comment-header">
                    <div class="avatar-placeholder">
                        @if (!empty($comment->user->prof) && $comment->user->prof->avatar)
                        <img src="{{ asset('storage/avatars/' . $comment->user->prof->avatar) }}" class="avatar-icon">
                        @endif
                    </div>
                    <span class="comment-user-name"><strong>{{ $comment->user->name }}</strong></span>
                </div>
                <div class="comment-text-block">
                    <p class="comment-text">{{ $comment->comment }}</p>
                </div>
            </div>
            @endforeach
            @else
            <p class="no-comment">まだコメントはありません。</p>
            @endif

            {{-- フォームの前に表示はここで終わり --}}
            <div class="comment-form-header" id="comment-form-header" style="display: flex; align-items: center; gap: 10px;">
                <h3 style="margin: 0;">商品へのコメント</h3>
                @error('comment')
                <script>
                    // ページを離れる直前にスクロール位置を保存
                    window.addEventListener('beforeunload', () => {
                        sessionStorage.setItem('scrollY', window.scrollY + 100);
                    });

                    // ページ読み込み時に保存された位置に戻す
                    window.addEventListener('load', () => {
                        const scrollY = sessionStorage.getItem('scrollY');
                        if (scrollY !== null) {
                            window.scrollTo(0, parseInt(scrollY));
                            sessionStorage.removeItem('scrollY');
                        }
                    });
                </script>
                <span class="comment-error">{{ $message }}</span>
                @enderror
                @if ($errors->has('comment'))
                @endif
            </div>

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <textarea name="comment"
                    placeholder=""
                    @guest disabled style="background-color: #eee; cursor: not-allowed;" @endguest>{{ old('comment') }}</textarea>
                <button type="submit"
                    class="buy-btn full-width @guest btn-disabled @endguest"
                    @guest disabled style="cursor: not-allowed;" @endguest>
                    コメントを送信する
                </button>
            </form>
        </section>
    </div>
</div>
@endsection

<script>
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
</script>

@if (session('scrollToCommentForm'))
<script>
    window.addEventListener('load', function() {
        if (performance && performance.navigation.type === 1) return;

        const target = document.getElementById('comment-form-header');
        if (target) {
            const y = target.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({
                top: y + 100,
                behavior: 'smooth'
            });
        }
    });
</script>
@else
<script>
    if (performance && performance.navigation.type === 1) {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'auto'
        });
    }
</script>
@endif