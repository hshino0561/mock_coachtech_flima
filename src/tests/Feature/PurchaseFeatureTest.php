<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class PurchaseFeatureTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('email', 'user@example.com')->firstOrFail();
    }

    /** 1. 購入処理が完了する */
    public function test_1_購入処理が完了する()
    {
        $this->actingAs($this->user);

        // ? プロフィール住所を明示的にセット
        $this->user->prof()->updateOrCreate([], [
            'postal_code' => '123-4567',
            'address'     => '東京都渋谷区1-2-3',
            'building'    => 'フルマビル301',
        ]);

        // ? 未購入の商品を取得
        $product = Product::where('is_sold', false)->firstOrFail();

        // ? 支払い方法のみ指定して購入処理をPOST
        $response = $this->post("/purchase/{$product->id}", [
            'payment_method' => 'コンビニ支払い'
        ]);

        // ? 正常にリダイレクトされることを確認
        $response->assertRedirect(route('mypage', ['page' => 'buy']));

        // ? productsテーブルの is_sold が true に更新されたか確認
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_sold' => true,
        ]);
    }

    /** 2. 購入済み商品は一覧で sold表示される */
    public function test_2_購入済み商品は一覧で_sold表示される()
    {
        $this->actingAs($this->user);

        $soldProduct = Product::where('is_sold', true)
            ->where('user_id', '!=', $this->user->id)
            ->firstOrFail();

        $response = $this->get('/?page=recommend');
        $response->assertStatus(200);
        $response->assertSee('Sold');
        $response->assertSee($soldProduct->name);
    }

    /** 3. 購入済み商品がプロフィールに表示される */
    public function test_3_購入済み商品がプロフィールに表示される()
    {
        $this->actingAs($this->user);

        // 購入処理と同等のデータ登録を行う
        $product = \App\Models\Product::where('is_sold', true)->firstOrFail();

        // ordersテーブルの中で、自分が購入した商品のIDを取得
        $purchasedItemId = \App\Models\Order::where('buyer_id', $this->user->id)
            ->where('item_id', $product->id)
            ->value('item_id');

        // プロフィール画面にアクセス（購入済み商品一覧が含まれる）
        $response = $this->get('/mypage?page=buy');

        // 表示内容を確認
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Sold');
    }
}
