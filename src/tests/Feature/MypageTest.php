<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class MypageTest extends TestCase
{
    // use RefreshDatabase;

    public function test_ユーザー情報がマイページに表示されること()
    {
        // プロフィールあり＆出品済＆購入済のユーザーを取得
        $user = User::whereHas('prof')
            ->whereHas('products')
            ->whereHas('orders')
            ->first();

        $this->assertNotNull($user, '条件に合うユーザーが存在しないためテストできません');

        // マイページ出品一覧の表示テスト
        $response = $this->actingAs($user)->get('/mypage?page=sell');
        $response->assertStatus(200);
        $response->assertSee($user->name); // ユーザー名
        $response->assertSee('<img', false); // プロフィール画像（<img が含まれるか）

        foreach ($user->products as $product) {
            $response->assertSee($product->name); // 出品した商品名
        }

        // マイページ購入一覧の表示テスト
        $response2 = $this->actingAs($user)->get('/mypage?page=buy');
        $response2->assertStatus(200);
        foreach ($user->orders as $order) {
            $purchasedProduct = $order->product;
            if ($purchasedProduct) {
                $response2->assertSee($purchasedProduct->name); // 購入商品名
            }
        }
    }
}
