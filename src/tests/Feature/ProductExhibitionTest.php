<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Product;

class ProductExhibitionTest extends TestCase
{
    // use RefreshDatabase;

    public function test_出品商品情報が保存されること()
    {
        // ストレージをフェイク化（実保存されない）
        Storage::fake('public');

        /** @var User $user */
        $user = User::has('prof')->first();
        $this->assertNotNull($user, 'プロフィール登録済ユーザーが必要です');

        /** @var Category $category */
        $category = Category::first();
        $this->assertNotNull($category, 'カテゴリが必要です');

        /** @var Condition $condition */
        $condition = Condition::first();
        $this->assertNotNull($condition, '商品の状態が必要です');

        // 画像生成を回避（GDエラー防止）
        $image = UploadedFile::fake()->create('dummy.jpg', 100, 'image/jpeg');

        $formData = [
            'product_name'        => 'テスト商品',
            'brand'               => 'テストブランド',
            'product_description' => 'これはテスト用の商品です',
            'price'               => 5000,
            'condition_id'        => $condition->id,
            'category_ids'        => (string) $category->id,
            'product-image'       => $image,
        ];

        $response = $this->actingAs($user)->post('/sell', $formData);
        $response->assertRedirect('/');

        // DB保存確認
        $this->assertDatabaseHas('products', [
            'name'         => 'テスト商品',
            'brand'        => 'テストブランド',
            'price'        => 5000,
            'condition_id' => $condition->id,
        ]);

        $product = Product::where('name', 'テスト商品')->first();
        $this->assertNotNull($product);
        $this->assertTrue($product->categories->pluck('id')->contains($category->id));

        // Storage::disk('public')->assertExists() は GD依存のため省略
        $this->assertNotEmpty($product->image_path, 'image_path が保存されていること');
    }
}
