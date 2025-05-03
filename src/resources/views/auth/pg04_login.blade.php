@extends('layouts.common_app1')

@section('title', 'ログイン画面') {{-- タイトルは専用セクションに分離 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg04_login.css') }}">
@endsection

<!-- エラーメッセージの表示(デバッグ用) -->
<!-- @if ($errors->any())
<div class="form-errors">
    <ul>
        @foreach ($errors->keys() as $field)
        @foreach ($errors->get($field) as $message)
        <li><strong>{{ $field }}:</strong> {{ $message }}</li>
        @endforeach
        @endforeach
    </ul>
</div>
@endif -->

@section('content')
<main class="login-container">
    <h1>ログイン</h1>
    <form action="{{ route('login') }}" method="post" class="login-form">
        @csrf
        <div class="form-group">
            <label for="login">メールアドレス　
                @error('login')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="text" id="login" name="login" value="{{ old('login') }}">
        </div>

        <div class="form-group">
            <label for="password">パスワード　
                @error('password')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit" class="login-button">ログインする</button>
    </form>

    <p class="register-link">
        <a href="/register">会員登録はこちら</a>
    </p>
</main>
@endsection