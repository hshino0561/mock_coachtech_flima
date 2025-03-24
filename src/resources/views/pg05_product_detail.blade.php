<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg05_product_detail.css') }}" />
</head>
<body>

    <header class="header">
        <div class="logo">COACHTECH</div>
        <div class="search-bar">
            <input type="text" placeholder="なにをお探しですか？">
        </div>
        <nav class="nav-links">
            <a href="#">ログイン</a>
            <a href="#">マイページ</a>
            <a href="#" class="sell-btn">出品</a>
        </nav>
    </header>

    <main class="product-detail">
        <div class="product-image">
            <img src="placeholder.png" alt="商品画像">
        </div>

        <div class="product-info">
            <h1>商品名がここに入る</h1>
            <p class="brand">ブランド名</p>
            <p class="price">\47,000 <span>(税込)</span></p>

            <div class="product-actions">
                <span>< 3</span>
                <span>?? 1</span>
            </div>

            <a href="#" class="buy-btn">購入手続きへ</a>

            <section class="product-description">
                <h2>商品説明</h2>
                <p>カラー：グレー</p>
                <p>新品<br>商品の状態は良好です。傷もありません。</p>
                <p>購入後、即発送いたします。</p>
            </section>

            <section class="product-details">
                <h2>商品の情報</h2>
                <p>カテゴリー: 洋服 > メンズ</p>
                <p>商品の状態: 良好</p>
            </section>

            <section class="comments">
                <h2>コメント(1)</h2>
                <div class="comment">
                    <div class="comment-user">
                        <img src="user-icon.png" alt="ユーザーアイコン" class="user-icon">
                        <span>admin</span>
                    </div>
                    <p>こちらにコメントが入ります。</p>
                </div>

                <h3>商品へのコメント</h3>
                <form action="comment.php" method="POST">
                    <textarea name="comment" placeholder="コメントを入力してください" required></textarea>
                    <button type="submit">コメントを送信する</button>
                </form>
            </section>
        </div>
    </main>

</body>
</html>
