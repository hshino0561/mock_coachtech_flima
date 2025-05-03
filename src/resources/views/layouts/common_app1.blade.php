<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'デフォルトタイトル')</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common1.css') }}">
  @yield('css')
  @yield('head')
</head>

<body>
  <header class="header">
    <div class="logo-container">
      <a href="{{ url('/') }}">
          <img src="{{ asset('storage/img/logo.png') }}" alt="COACHTECHロゴ" class="logo">
      </a>
    </div>

    @if (!Request::routeIs('login') && !Request::routeIs('register') && !Request::routeIs('verification.*'))
    <!-- 通常画面のみナビゲーション表示 -->
    <nav class="nav-bar">
      <div class="nav-left"></div>

      <!-- 共通テンプレート内の検索窓 -->
      <form action="{{ route('top') }}" method="GET" class="nav-center">
        <input type="text" name="keyword" value="{{ request('keyword') }}" class="search-box" placeholder="なにをお探しですか？">
      </form>

      <div class="nav-right nav-links">
        @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">ログアウト</button>
        </form>

        <script>
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function () {
                    // 支払い方法の一時データをクリア
                    sessionStorage.removeItem('payment_method');
                });
            }
        </script>
        @endauth

        @guest
        <a href="{{ route('login') }}">ログイン</a>
        @endguest

        <a href="{{ route('mypage') }}">マイページ</a>
        <a href="{{ route('sell') }}" class="sell-button">出品</a>
      </div>
    </nav>
    @endif
  </header>

  <main>
    @yield('content')
  </main>
  @yield('js')
</body>

</html>