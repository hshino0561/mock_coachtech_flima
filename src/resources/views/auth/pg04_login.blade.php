<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg04_login.css') }}" />
</head>
<body>
    <header class="header">
        <img src="logo.png" alt="COACHTECHロゴ" class="logo">
    </header>

    <main class="login-container">
        <h1>ログイン</h1>
        <form action="#" method="post" class="login-form">
            <div class="form-group">
                <label for="username">ユーザー名 / メールアドレス</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-button">ログインする</button>
        </form>

        <p class="register-link">
            <a href="#">会員登録はこちら</a>
        </p>
    </main>
</body>
</html>
