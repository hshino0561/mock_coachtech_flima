<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール設定</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg10_prof_edit.css') }}" />
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="{{ asset('storage/img/logo.png') }}" alt="COACHTECHロゴ" class="logo">
        </div>
        <nav class="nav-bar">
            <input type="text" placeholder="なにをお探しですか？" class="search-box">
            <div class="nav-links">
                <!-- ログアウトボタンをフォーム化 -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">ログアウト</button>
                </form>
                <a href="/mypage">マイページ</a>
                <a href="#" class="sell-button">出品</a>
            </div>
        </nav>
    </header>

    <main class="profile-settings-container">
        <h1>プロフィール設定</h1>
        
        <div class="avatar-section">
            <div class="avatar"></div>
            <button class="image-select-button">画像を選択する</button>
        </div>

        <form action="#" method="post" class="settings-form">
            @csrf
            <div class="form-group">
                <label for="username">ユーザー名</label>
                <input type="text" id="username" name="username" value="既存の値が入力されている">
            </div>

            <div class="form-group">
                <label for="postal-code">郵便番号</label>
                <input type="text" id="postal-code" name="postal_code" value="既存の値が入力されている">
            </div>

            <div class="form-group">
                <label for="address">住所</label>
                <input type="text" id="address" name="address" value="既存の値が入力されている">
            </div>

            <div class="form-group">
                <label for="building">建物名</label>
                <input type="text" id="building" name="building" value="既存の値が入力されている">
            </div>

            <button type="submit" class="update-button">更新する</button>
        </form>
    </main>
</body>
</html>
