<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryAddressTest extends TestCase
{
    // use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('email', 'user@example.com')->firstOrFail();
    }

    public function test_1_住所変更後に購入画面に反映されている()
    {
        $this->actingAs($this->user);

        $product = Product::where('is_sold', false)
            ->where('user_id', '!=', $this->user->id)
            ->firstOrFail();

        // 仮住所をセッションに保存（画面操作の代替）
        session([
            "temp_address_{$product->id}" => [
                'postal_code' => '999-9999',
                'address'     => 'テスト市テスト町',
                'building'    => 'テストビル202',
            ],
        ]);

        $response = $this->get("/purchase/{$product->id}");

        $response->assertStatus(200);
        $response->assertSee('999-9999');
        $response->assertSee('テスト市テスト町');
        $response->assertSee('テストビル202');
    }

    public function test_2_購入時に変更済み住所が保存される()
    {
        $this->actingAs($this->user);

        $product = Product::where('is_sold', false)
            ->where('user_id', '!=', $this->user->id)
            ->firstOrFail();

        // 仮住所をセッションに保存
        session([
            "temp_address_{$product->id}" => [
                'postal_code' => '888-8888',
                'address'     => '変更市変更町',
                'building'    => '変更ビル101',
            ],
        ]);

        $response = $this->post("/purchase/{$product->id}", [
            'payment_method' => 'カード支払い',
        ]);

        $response->assertRedirect(route('mypage', ['page' => 'buy']));

        $this->assertDatabaseHas('orders', [
            'item_id'              => $product->id,
            'buyer_id'             => $this->user->id,
            'delivery_postal_code' => '888-8888',
            'delivery_address'     => '変更市変更町',
            'delivery_building'    => '変更ビル101',
        ]);
    }
}
