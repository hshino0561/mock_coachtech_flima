<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg05_2_product_detail.css') }}" />
</head>
<body>

    <!-- ヘッダー -->
    <header class="header">
        <div class="header-content">
            <img src="logo.png" alt="COACHTECHロゴ" class="logo">
            <input type="text" placeholder="なにをお探しですか？" class="search-bar">
            <nav class="nav-links">
                <a href="#">ログアウト</a>
                <a href="#">マイページ</a>
                <a href="#" class="cta-button">出品</a>
            </nav>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="product-container">
        <!-- 商品画像 -->
        <div class="product-image">
            <p>商品画像</p>
        </div>

        <!-- 商品詳細情報 -->
        <div class="product-details">
            <h1>商品名がここに入る</h1>
            <p class="brand">ブランド名</p>
            <p class="price">\47,000（税込）</p>

            <div class="product-actions">
                <span>< 3</span>
                <span>?? 1</span>
                <button class="purchase-btn">購入手続きへ</button>
            </div>

            <!-- 商品説明 -->
            <section class="product-description">
                <h2>商品説明</h2>
                <p>カラー：グレー</p>
                <p>新品</p>
                <p>商品の状態は良好です。傷もありません。</p>
                <p>購入後、即発送いたします。</p>
            </section>

            <!-- 商品情報 -->
            <section class="product-info">
                <h2>商品の情報</h2>
                <p><strong>カテゴリー：</strong> 洋服・メンズ</p>
                <p><strong>商品の状態：</strong> 良好</p>
            </section>

            <!-- コメント -->
            <section class="comments-section">
                <h2>コメント (1)</h2>
                <div class="comment">
                    <div class="comment-avatar"></div>
                    <p class="comment-user">admin</p>
                    <p class="comment-text">こちらにコメントが入ります。</p>
                </div>

                <h3>商品へのコメント</h3>
                <textarea placeholder="コメントを入力してください"></textarea>
                <button class="comment-btn">コメントを送信する</button>
            </section>
        </div>
    </main>

</body>
</html>
