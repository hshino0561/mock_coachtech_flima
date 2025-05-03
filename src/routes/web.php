<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\OrderController;

use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;

// 商品一覧画面用
Route::get('/', [ItemController::class, 'index'])->name('top');
Route::get('/item_search', [ItemController::class, 'index'])->name('items.search');
Route::get('/item/{item_id}', [ItemController::class, 'showdetail'])->name('item.showdetail');

// 公開ルート（ゲスト専用）
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// 認証＆メール認証済みルート（verifiedミドルウェア追加）
Route::middleware(['auth', 'verified'])->group(function () {
    // マイページ
    Route::get('/mypage', [ProfController::class, 'mypage'])->name('mypage');

    // 初回ログイン時に遷移する「プロフィール設定」
    Route::get('/mypage/profile', [ProfController::class, 'profUpd'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfController::class, 'update'])->name('profile.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 商品詳細（いいね/コメント）
    Route::post('/item/{id}/like-toggle', [ItemController::class, 'toggleLike'])->name('item.like.toggle');
    Route::post('/item/comment', [ItemController::class, 'storeComment'])->name('comments.store');

    // 出品
    Route::get('/sell', [SellController::class, 'sell'])->name('sell');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');

    // 購入処理
    Route::get('/purchase/{item_id}', [OrderController::class, 'showPurchaseConfirm'])->name('purchase.show');
    Route::get('/purchase/address/{item_id}', [OrderController::class, 'editAddress'])->name('purchase.edit_address');
    Route::put('/purchase/address/{item_id}', [OrderController::class, 'updateAddress'])->name('address.update');
    Route::post('/purchase/{item_id}', [OrderController::class, 'purchase'])->name('purchase.execute');
});
