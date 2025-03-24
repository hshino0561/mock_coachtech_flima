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

    @if ($errors->any())
    <div>
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
            <label for="username">ユーザー名</label>
            <input type="text" id="name" name="name" required>

            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">確認用パスワード</label>
            <input type="password" id="confirm-password" name="password_confirmation" required>

            <button type="submit" class="submit-btn">登録する</button>
        </form>
        <p class="login-link"><a href="#">ログインはこちら</a></p>
    </main>

</body>
</html>
