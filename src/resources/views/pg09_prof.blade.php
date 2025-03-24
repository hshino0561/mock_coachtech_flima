<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィールページ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg09_prof.css') }}" />
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

    <main class="profile-container">
        <section class="user-info">
            <div class="avatar"></div>
            <h2 class="username">ユーザー名</h2>
            <button class="edit-profile-button">プロフィールを編集</button>
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
</body>
</html>
