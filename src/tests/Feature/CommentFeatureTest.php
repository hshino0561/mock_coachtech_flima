<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentFeatureTest extends TestCase
{
    // use RefreshDatabase;

    private $user;
    private $product;

    protected function setUp(): void
    {
        parent::setUp();

        // 既存ユーザーを取得
        $this->user = \App\Models\User::where('email', 'user@example.com')->firstOrFail();

        // 自分以外の商品のうち、少なくとも1件コメント可能な商品を取得
        $this->product = \App\Models\Product::where('user_id', '!=', $this->user->id)->firstOrFail();
    }

    public function test_1_ログインユーザーはコメントを送信できる()
    {
        $this->actingAs($this->user);

        $response = $this->post('/item/comment', [
            'product_id' => $this->product->id,
            'comment' => '使いやすそうですね！',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'comment' => '使いやすそうですね！',
        ]);
    }

    public function test_2_未ログインユーザーはコメントできない()
    {
        $response = $this->post('/item/comment', [
            'product_id' => $this->product->id,
            'comment' => '匿名で失礼します。',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('comments', [
            'product_id' => $this->product->id,
            'comment' => '匿名で失礼します。',
        ]);
    }

    public function test_3_コメント未入力の場合バリデーションエラー()
    {
        $this->actingAs($this->user);

        $response = $this->from("/item/{$this->product->id}")->post('/item/comment', [
            'product_id' => $this->product->id,
            'comment' => '',
        ]);

        $response->assertRedirect("/item/{$this->product->id}");
        $response->assertSessionHasErrors('comment');
    }

    public function test_4_コメントが255文字超過でバリデーションエラー()
    {
        $this->actingAs($this->user);

        $longComment = str_repeat('あ', 256);

        $response = $this->from("/item/{$this->product->id}")->post('/item/comment', [
            'product_id' => $this->product->id,
            'comment' => $longComment,
        ]);

        $response->assertRedirect("/item/{$this->product->id}");
        $response->assertSessionHasErrors('comment');
    }
}
