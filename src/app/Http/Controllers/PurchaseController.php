<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $product = Product::findOrFail($item_id);
        $user = Auth::user();
        $profile = $user->prof; // profは1対1リレーション想定

        return view('pg06_purchase', compact('product', 'profile'));
    }
}
