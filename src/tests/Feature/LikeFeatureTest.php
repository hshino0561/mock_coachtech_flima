<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class LikeFeatureTest extends TestCase
{
    // use RefreshDatabase;

    private $user;
    private $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('email', 'user@example.com')->firstOrFail();

        // 「まだいいねしていない」かつ「他人の商品」から1件取得
        $this->product = Product::where('user_id', '!=', $this->user->id)
            ->whereDoesntHave('likes', fn($q) => $q->where('user_id', $this->user->id))
            ->firstOrFail();
    }

    public function test_1_いいねを押すと登録されいいね数が増える()
    {
        $this->actingAs($this->user);

        $product = Product::where('user_id', '!=', $this->user->id)
            ->whereDoesntHave('likes', fn($q) => $q->where('user_id', $this->user->id))
            ->firstOrFail();

        $beforeCount = $product->likes()->count();

        $response = $this->post("/item/{$product->id}/like-toggle");
        $response->assertRedirect();

        $this->assertDatabaseHas('likes', [
            'user_id' => $this->user->id,
            'product_id' => $product->id,
        ]);

        $afterCount = $product->refresh()->likes()->count();
        $this->assertEquals($beforeCount + 1, $afterCount);
    }

    public function test_2_いいねアイコンが押された後は色が変わる()
    {
        $this->actingAs($this->user);

        $product = Product::where('user_id', '!=', $this->user->id)
            ->whereHas('likes', fn($q) => $q->where('user_id', $this->user->id))
            ->firstOrFail();

        $response = $this->get("/item/{$product->id}");
        $response->assertStatus(200);
        $response->assertSee('星アイコン_like_on.png');
    }

    public function test_3_再度いいねを押すと解除されいいね数が減少する()
    {
        $this->actingAs($this->user);

        $product = Product::where('user_id', '!=', $this->user->id)
            ->whereHas('likes', fn($q) => $q->where('user_id', $this->user->id))
            ->firstOrFail();

        $beforeCount = $product->likes()->count();

        $response = $this->post("/item/{$product->id}/like-toggle");
        $response->assertRedirect();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->user->id,
            'product_id' => $product->id,
        ]);

        $afterCount = $product->refresh()->likes()->count();
        $this->assertEquals($beforeCount - 1, $afterCount);
    }
}
