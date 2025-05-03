@extends('layouts.common_app1')

@section('title', 'プロフィール設定')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg10_prof_edit.css') }}">
@endsection

{{-- @if ($errors->any())
<div class="form-errors">
    <ul>
        @foreach ($errors->keys() as $field)
            @foreach ($errors->get($field) as $message)
                <li><strong>{{ $field }}:</strong> {{ $message }}</li>
            @endforeach
        @endforeach
    </ul>
</div>
@endif --}}

@section('content')
<main class="profile-settings-container">
    <h1>プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="post" class="settings-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="avatar-section">
            <div class="avatar-wrapper">
                <div class="avatar-placeholder">
                    <img id="avatar-preview"
                        src="{{ !empty($prof) && $prof->avatar ? asset('storage/avatars/' . $prof->avatar) : '' }}"
                        class="avatar-icon"
                        style="{{ empty($prof) || !$prof->avatar ? 'display: none;' : '' }}">
                </div>

                <div class="avatar-controls">
                    <label for="avatar" class="image-select-button">画像を選択する</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;">

                    {{-- エラーメッセージ表示 --}}
                    @error('avatar')
                    <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- プレビュー用のJavaScript --}}
        <script>
            document.getElementById('avatar').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const preview = document.getElementById('avatar-preview');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                }
            });
        </script>
        </div>

        <div class="form-group">
            <label for="username">ユーザー名　
                @error('username')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->name ?? '') }}">
        </div>

        <div class="form-group">
            <label for="postal-code">郵便番号　
                @error('postal_code')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="text" id="postal-code" name="postal_code" value="{{ old('postal_code', $prof->postal_code ?? '') }}">
        </div>

        <div class="form-group">
            <label for="address">住所　
                @error('address')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="text" id="address" name="address" value="{{ old('address', $prof->address ?? '') }}">
        </div>

        <div class="form-group">
            <label for="building">建物名　
                @error('building')
                <span class="field-error">{{ $message }}</span>
                @enderror
            </label>
            <input type="text" id="building" name="building" value="{{ old('building', $prof->building ?? '') }}">
        </div>

        <button type="submit" class="update-button">更新する</button>
    </form>
</main>
@endsection