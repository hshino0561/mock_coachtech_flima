@extends('layouts.app1')

@section('title', 'ログイン画面') {{-- タイトルは専用セクションに分離 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg04_login.css') }}">
@endsection

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

@section('content')
    <main class="login-container">
        <h1>ログイン</h1>
        <form action="{{ route('login') }}" method="post" class="login-form">
            @csrf
            <div class="form-group">
               <label for="login">ユーザー名 / メールアドレス</label>
               <!-- old('login')を使用してエラー時にも値を保持 -->
               <input type="text" id="login" name="login" value="{{ old('login') }}" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-button">ログインする</button>
        </form>

        <p class="register-link">
            <a href="/register">会員登録はこちら</a>
        </p>
    </main>
@endsection