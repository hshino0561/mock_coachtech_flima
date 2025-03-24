<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfController;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', [ProductController::class, 'list']);
Route::get('/sell', [SellController::class, 'sell']);
Route::get('/mypage', [ProfController::class, 'prof']);
Route::get('/mypage/profile', [ProfController::class, 'profUpd']);
Route::middleware(['guest'])->group(function () {
    // Register route
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
