<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
    // use RefreshDatabase;

    public function test_1_商品詳細に必要な情報が表示される()
    {
        $product = Product::whereNotNull('image_path')
            ->whereNotNull('brand')
            ->whereNotNull('price')
            ->whereNotNull('description')
            ->where('is_sold', false)
            ->has('categories')
            ->has('comments')
            ->has('likes')
            ->firstOrFail();

        $response = $this->get(route('item.showdetail', ['item_id' => $product->id]));

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->brand);
        $response->assertSee(number_format($product->price));
        $response->assertSee($product->description);
        $response->assertSee($product->condition->name); // 商品の状態（例: 新品）

        $response->assertSee((string) $product->likes->count());
        $response->assertSee((string) $product->comments->count());

        foreach ($product->categories as $category) {
            $response->assertSee($category->name);
        }

        foreach ($product->comments as $comment) {
            $response->assertSee($comment->user->name);
            $response->assertSee($comment->content);
        }
    }

    public function test_2_複数選択されたカテゴリが表示されている()
    {
        // 複数カテゴリが紐づいている商品を取得
        $product = \App\Models\Product::whereHas('categories', function ($q) {
            $q->havingRaw('count(*) > 1');
        }, '>=', 2)->firstOrFail();

        $response = $this->get(route('item.showdetail', ['item_id' => $product->id]));
        $response->assertStatus(200);

        foreach ($product->categories as $category) {
            $response->assertSee($category->name);
        }
    }
}
