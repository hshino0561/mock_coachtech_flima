<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg03_member_register.css') }}" />
</head>
<body>

    <header class="header">
        <img src="storage/img/logo.png" alt="COACHTECHロゴ" class="logo">
    </header>

    <!-- エラーメッセージの表示 -->
    @if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <main class="form-container">
        <h1>会員登録</h1>
        <form action="{{ route('register') }}" method="post" class="registration-form">
            @csrf
            
            <!-- ユーザー名 -->
            <label for="name">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <!-- メールアドレス -->
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <!-- パスワード -->
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>

            <!-- 確認用パスワード -->
            <label for="confirm-password">確認用パスワード</label>
            <input type="password" id="confirm-password" name="password_confirmation" required>

            <button type="submit" class="submit-btn">登録する</button>
        </form>

        <p class="login-link"><a href="/login">ログインはこちら</a></p>
    </main>

</body>
</html>
