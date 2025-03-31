<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトタイトル')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common2.css') }}">
    @yield('css')
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
                <a href="#">マイページ</a>
                <a href="#" class="sell-button">出品</a>
            </div>
        </nav>
    </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
