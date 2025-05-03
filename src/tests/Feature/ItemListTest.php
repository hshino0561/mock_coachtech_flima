<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemListTest extends TestCase
{
    // use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = \App\Models\User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'is_first_login' => true,
            ]
        );
    }

    public function test_1_全商品を取得できる()
    {
        // Product::factory()->count(3)->create();

        $response = $this->followingRedirects()->get('/');

        $response->assertStatus(200);
        $products = Product::all();
        foreach ($products as $product) {
            $response->assertSee($product->name);
        }
    }

    public function test_2_購入済み商品にはSoldと表示される()
    {
        // Product::factory()->create(['name' => '売れた商品', 'is_sold' => true]);

        // 既に is_sold = true の商品を1件取得（該当商品が存在することが前提）
        $soldProduct = \App\Models\Product::where('is_sold', true)->firstOrFail();

        $response = $this->followingRedirects()->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
        $response->assertSee($soldProduct->name);
    }

    public function test_3_自分が出品した商品は表示されない()
    {
        $user = \App\Models\User::where('email', 'user@example.com')->firstOrFail();
        $this->actingAs($user);

        // 自分の商品
        Product::factory()->create([
            'user_id' => $user->id,
            'name' => '自分の商品名',
        ]);

        // 他人の商品
        Product::factory()->create(['user_id' => $user->id - 1]);

        $response = $this->get('/?page=recommend');
        $response->assertStatus(200);
        $response->assertDontSee('自分の商品名');
    }
}
