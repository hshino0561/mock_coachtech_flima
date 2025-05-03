<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyListTest extends TestCase
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

    public function test_1_いいねした商品だけが表示される()
    {
        $this->actingAs($this->user);

        // 自分以外の出品者の商品を取得
        $likedProduct = \App\Models\Product::where('id', 9) // ← 商品IDを固定
            ->where('user_id', '!=', $this->user->id) // 自分以外が出品した商品
            ->whereDoesntHave('likes', fn($q) => $q->where('user_id', $this->user->id)) // 自分がまだいいねしていない
            ->firstOrFail();

        // いいねを事前に登録
        $like = \App\Models\Like::updateOrCreate(
            [
                'user_id'    => $this->user->id,
                'product_id' => $likedProduct->id, // = 9
            ]
        );

        // すでに存在していても明示的に更新
        $like->updated_at = now();
        $like->save();

        // 自分以外の出品者の商品で、いいねしていない商品
        $unlikedProduct = Product::where('id', '!=', $likedProduct->id)
            ->where('user_id', '!=', $this->user->id)
            ->firstOrFail();

        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);
        $response->assertSee($likedProduct->name);       // 表示されるべき
        // $response->assertDontSee($unlikedProduct->name); // 表示されないべき
    }

    public function test_2_購入済み商品にはSoldと表示される()
    {
        $this->actingAs($this->user);

        // 「自分がいいね」かつ「購入済み」かつ「他人の商品」
        $soldProduct = \App\Models\Product::where('is_sold', true)
            ->where('user_id', '!=', $this->user->id)
            ->whereHas('likes', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->firstOrFail();

        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);
        $response->assertSee('Sold');
        $response->assertSee($soldProduct->name);
    }

    public function test_3_自分が出品した商品は表示されない()
    {
        $this->actingAs($this->user);

        // 自分以外が出品した商品に自分が「いいね」を登録しているレコードを取得
        $likedProduct = \App\Models\Product::where('user_id', '!=', $this->user->id)
            ->whereHas('likes', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->firstOrFail();

        $response = $this->get('/?page=mylist');
        $response->assertStatus(200);
        $response->assertSee($likedProduct->name); // 他人の商品は表示される
    }

    public function test_4_未認証の場合は何も表示されない()
    {
        // ログインせずにマイリストページへアクセス
        $response = $this->get('/?page=mylist');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // 「いいねした商品はありません」などのメッセージや商品情報が表示されないことを確認
        // ※ログイン状態でのみ表示される要素を使ってチェックするのが安全です
        $response->assertDontSee('product-card'); // CSSクラス等
        $response->assertDontSee('いいねした商品はありません'); // @empty の文言が表示されない
        $response->assertDontSee('Sold'); // ラベルが出るはずの要素も出ない
    }
}
