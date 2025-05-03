<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentSelectionTest extends TestCase
{
    // use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // 既存のテストで登録されたユーザーを使用
        $this->user = User::where('email', 'user@example.com')->firstOrFail();
    }

    public function test_支払い方法が注文情報に正しく表示される()
    {
        $this->actingAs($this->user);

        // 最新の注文情報を取得
        $order = Order::where('buyer_id', $this->user->id)->latest()->firstOrFail();

        // 該当する商品ページ（購入確認）へアクセス
        $response = $this->get("/purchase/{$order->item_id}");

        $response->assertStatus(200);
        $response->assertSee($order->payment_method); // 表示反映の確認
    }
}
