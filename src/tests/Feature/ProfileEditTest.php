<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProfileEditTest extends TestCase
{
    // use RefreshDatabase;

    public function test_ユーザー情報変更画面に初期値が表示されること()
    {
        // prof情報があるユーザーを取得
        $user = User::whereHas('prof')->first();
        $this->assertNotNull($user, 'プロフィール登録済みユーザーが必要です');

        $prof = $user->prof;

        // 編集画面にアクセス
        $response = $this->actingAs($user)->get('/mypage/profile');

        $response->assertStatus(200);

        // ユーザー名、郵便番号、住所などがフォームの初期値として表示されているか確認
        $response->assertSee('value="' . e($user->name) . '"', false); // ユーザー名
        $response->assertSee('value="' . e($prof->postal_code) . '"', false); // 郵便番号
        $response->assertSee('value="' . e($prof->address) . '"', false);     // 住所
        $response->assertSee('value="' . e($prof->building) . '"', false);    // 建物名

        // プロフィール画像が表示されていること（<img src="..."）
        if ($prof->avatar) {
            $response->assertSee('avatars/' . $prof->avatar, false);
        }
    }
}
