<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトタイトル')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common1.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <img src="{{ asset('storage/img/logo.png') }}" alt="COACHTECHロゴ" class="logo">
    </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
