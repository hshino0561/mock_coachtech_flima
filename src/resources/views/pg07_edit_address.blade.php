@extends('layouts.common_app1')

@section('title', '住所の変更')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pg07_edit_address.css') }}">
@endsection

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
<div class="form-container">
    <h1>住所の変更</h1>

    <form action="{{ route('address.update', ['item_id' => $product->id]) }}" method="POST" class="address-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="label-with-error">
                <label for="postal_code">郵便番号　</label>
                @error('postal_code')
                <span class="field-error-inline">{{ $message }}</span>
                @enderror
            </div>
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}">
        </div>

        <div class="form-row">
            <div class="label-with-error">
                <label for="address">住所　</label>
                @error('address')
                <span class="field-error-inline">{{ $message }}</span>
                @enderror
            </div>
            <input type="text" id="address" name="address" value="{{ old('address', $address->address ?? '') }}">
        </div>

        <div class="form-row">
            <div class="label-with-error">
                <label for="building">建物名　</label>
                @error('building')
                <span class="field-error-inline">{{ $message }}</span>
                @enderror
            </div>
            <input type="text" id="building" name="building" value="{{ old('building', $address->building ?? '') }}">
        </div>

        <button type="submit" class="submit-btn">更新する</button>
        <!-- <p>Debug: product ID = {{ $product->id }}</p> -->
        <!-- <p>Debug: postal_code = {{ $address->postal_code }}</p> -->
    </form>
</div>
@endsection