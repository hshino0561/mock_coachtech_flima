<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;

// 公開ルート（ゲスト専用）
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// 認証済みルート
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [ProfController::class, 'prof'])->name('mypage');
    Route::get('/mypage/profile', [ProfController::class, 'profUpd'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// 商品関連のルート
Route::get('/', [ProductController::class, 'list'])->name('home');
Route::get('/sell', [SellController::class, 'sell'])->name('sell');
