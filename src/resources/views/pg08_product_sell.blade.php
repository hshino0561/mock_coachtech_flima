<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品出品</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg08_product_sell.css') }}" />
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
    <main class="form-container">
        <h1>商品の出品</h1>

        <!-- 商品画像 -->
        <section class="product-image-section">
            <label for="product-image">商品画像</label>
            <div class="image-upload">
                <p>画像を選択する</p>
            </div>
            <input type="file" id="product-image" class="hidden-input">
        </section>

        <!-- 商品の詳細 -->
        <section class="product-details-section">
            <h2>商品の詳細</h2>

            <!-- カテゴリ -->
            <label>カテゴリ</label>
            <div class="categories">
                <span>ファッション</span>
                <span>家電</span>
                <span>インテリア</span>
                <span>レディース</span>
                <span>メンズ</span>
                <span>コスメ</span>
                <span>本</span>
                <span>ゲーム</span>
                <span>スポーツ</span>
                <span>キッチン</span>
                <span>ハンドメイド</span>
                <span>アクセサリー</span>
                <span>おもちゃ</span>
                <span>ベビー・キッズ</span>
            </div>

            <!-- 商品の状態 -->
            <label for="condition">商品の状態</label>
            <select id="condition">
                <option value="">選択してください</option>
                <option value="new">新品</option>
                <option value="no-scratches">目立った傷や汚れなし</option>
                <option value="slight-scratches">やや傷や汚れあり</option>
                <option value="damaged">傷や汚れが目立つ</option>
            </select>
        </section>

        <!-- 商品名と説明 -->
        <section class="product-description-section">
            <h2>商品名と説明</h2>

            <label for="product-name">商品名</label>
            <input type="text" id="product-name" placeholder="商品名を入力してください">

            <label for="product-description">商品の説明</label>
            <textarea id="product-description" placeholder="商品の説明を入力してください"></textarea>
        </section>

        <!-- 販売価格 -->
        <section class="product-price-section">
            <label for="price">販売価格</label>
            <div class="price-input">
                <span>\</span>
                <input type="number" id="price" placeholder="価格を入力してください">
            </div>
        </section>

        <button class="submit-btn">出品する</button>
    </main>

</body>
</html>
