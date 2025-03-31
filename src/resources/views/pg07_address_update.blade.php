<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>住所の変更</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg07_address_update.css') }}" />
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
        <h1>住所の変更</h1>

        <form action="#" method="post" class="address-form">
            <label for="postal-code">郵便番号</label>
            <input type="text" id="postal-code" name="postal-code" placeholder="郵便番号を入力してください" required>

            <label for="address">住所</label>
            <input type="text" id="address" name="address" placeholder="住所を入力してください" required>

            <label for="building">建物名</label>
            <input type="text" id="building" name="building" placeholder="建物名を入力してください">
            
            <button type="submit" class="submit-btn">更新する</button>
        </form>
    </main>

</body>
</html>
