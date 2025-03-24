<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール設定</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg10_2_first_prof.css') }}" />
</head>
<body>

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

    <main class="form-container">
        <h1>プロフィール設定</h1>

        <div class="profile-image-container">
            <div class="profile-image"></div>
            <button type="button" class="image-select-btn">画像を選択する</button>
        </div>

        <form action="#" method="post" class="profile-form">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" required>

            <label for="postal-code">郵便番号</label>
            <input type="text" id="postal-code" name="postal-code" required>

            <label for="address">住所</label>
            <input type="text" id="address" name="address" required>

            <label for="building">建物名</label>
            <input type="text" id="building" name="building">

            <button type="submit" class="submit-btn">更新する</button>
        </form>
    </main>

</body>
</html>
