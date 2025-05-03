<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Prof;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    // 購入確認画面の表示
    public function showPurchaseConfirm($item_id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($item_id);
        $profile = $user->prof;

        // セッションから配送先取得（仮住所）
        $tempAddress = session("temp_address_{$item_id}");

        return view('pg06_purchase', [
            'product' => $product,
            'profile' => $profile,
            'tempAddress' => $tempAddress,
        ]);
    }

    // ① 住所変更画面の初期表示
    public function editAddress($item_id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($item_id);

        // プロフィール情報
        $prof = $user->prof;

        // セッションの仮住所（存在すれば優先）
        $temp = session("temp_address_{$item_id}");

        // $address に優先的に仮データを詰める（null合体演算子で fallback）
        $address = (object) [
            'postal_code' => $temp['postal_code'] ?? $prof->postal_code,
            'address'     => $temp['address']     ?? $prof->address,
            'building'    => $temp['building']    ?? $prof->building,
        ];

        return view('pg07_edit_address', compact('product', 'address'));
    }

    // ② 住所変更の保存（セッションに一時保存）
    public function updateAddress(AddressRequest $request, $item_id)
    {
        $validated = $request->validated();

        session([
            "temp_address_{$item_id}" => [
                'postal_code' => $validated['postal_code'],
                'address'     => $validated['address'],
                'building'    => $validated['building'],
            ]
        ]);

        return redirect()->route('purchase.show', ['item_id' => $item_id])->withInput();
    }

    // ③ 購入処理
    public function purchase(PurchaseRequest $request, $item_id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($item_id);

        if ($product->is_sold) {
            return redirect()->back()->with('error', 'この商品はすでに売り切れました');
        }

        // セッションの仮住所があれば使う
        $temp = session("temp_address_{$item_id}");
        $postal = $temp['postal_code'] ?? $user->prof->postal_code;
        $addr   = $temp['address']     ?? $user->prof->address;
        $build  = $temp['building']    ?? $user->prof->building;

        // 登録
        Order::create([
            'buyer_id'             => $user->id,
            'item_id'              => $product->id,
            'price'                => $product->price,
            'delivery_postal_code' => $postal,
            'delivery_address'     => $addr,
            'delivery_building'    => $build,
            'payment_method'       => $request->payment_method,
            'is_sold'              => true,
        ]);

        // 商品の販売フラグ更新
        $product->update(['is_sold' => true]);

        // セッション削除（仮住所）
        session()->forget("temp_address_{$item_id}");

        return redirect()->route('mypage', ['page' => 'buy'])->with('success', '購入が完了しました');
    }
}
