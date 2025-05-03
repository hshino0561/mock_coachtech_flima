@extends('layouts.common_app1')

@section('title', '会員登録') {{-- タイトルは専用セクションに分離 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg03_member_register.css') }}">
@endsection

@section('content')
<main class="form-container">
    <h1>会員登録</h1>
    <form action="{{ route('register') }}" method="post" class="registration-form" novalidate>
        @csrf
        <!-- ユーザー名 -->
        <label for="name">ユーザー名　
            @error('name')
            <span class="field-error">{{ $message }}</span>
            @enderror
        </label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">

        <!-- メールアドレス -->
        <label for="email">メールアドレス　
            @error('email')
            <span class="field-error">{{ $message }}</span>
            @enderror
        </label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">

        <!-- パスワード -->
        <label for="password">パスワード　
            @error('password')
            @if (!str_contains($message, 'パスワードと一致しません'))
            <span class="field-error">{{ $message }}</span>
            @endif
            @enderror
        </label>
        <input type="password" id="password" name="password">

        <!-- 確認用パスワード -->
        <label for="password_confirmation">確認用パスワード　
            {{-- password_confirmation に直接付いたエラーを表示 --}}
            @error('password_confirmation')
            <span class="field-error">{{ $message }}</span>
            @enderror

            {{-- password.confirmed による一致エラーも表示 --}}
            @error('password')
            @if (str_contains($message, '一致しません'))
            <span class="field-error">{{ $message }}</span>
            @endif
            @enderror
        </label>

        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit" class="submit-btn">登録する</button>
    </form>

    <p class="login-link"><a href="/login">ログインはこちら</a></p>
</main>
@endsection