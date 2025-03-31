<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入確認</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg06_product_order.css') }}" />
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
    <main class="purchase-container">
        <!-- 左側の商品情報 -->
        <section class="product-info">
            <div class="product-image">
                <p>商品画像</p>
            </div>

            <div class="product-details">
                <h1>商品名</h1>
                <p class="price">\47,000</p>
            </div>

            <hr>

            <!-- 支払い方法 -->
            <section class="payment-method">
                <h2>支払い方法</h2>
                <select id="payment-select">
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
            </section>

            <hr>

            <!-- 配送先 -->
            <section class="shipping-address">
                <h2>配送先</h2>
                <p>〒 XXX-YYYY<br>ここには住所と建物が入ります</p>
                <a href="#">変更する</a>
            </section>
        </section>

        <!-- 右側の注文情報 -->
        <aside class="order-summary">
            <div class="summary-box">
                <p><strong>商品代金</strong> <span>\47,000</span></p>
                <p><strong>支払い方法</strong> <span id="payment-method-display">コンビニ払い</span></p>
            </div>
            <button class="purchase-btn">購入する</button>
        </aside>
    </main>

    <!-- 外部JavaScriptファイルの読み込み -->
    <script src="js/pg06_product_order.js" defer></script>

</body>
</html>
