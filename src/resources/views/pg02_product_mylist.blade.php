<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイリスト</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg02_product_mylist.css') }}" />
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="logo.png" alt="COACHTECHロゴ" class="logo">
        </div>
        <nav class="nav-bar">
            <input type="text" placeholder="なにをお探しですか？" class="search-box">
            <div class="nav-links">
                <a href="#">ログアウト</a>
                <a href="#">マイページ</a>
                <a href="#" class="sell-button">出品</a>
            </div>
        </nav>
    </header>

    <main class="mylist-container">
        <div class="tab-menu">
            <a href="#" class="tab">おすすめ</a>
            <a href="#" class="tab active-tab">マイリスト</a>
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
        </section>
    </main>
</body>
</html>
