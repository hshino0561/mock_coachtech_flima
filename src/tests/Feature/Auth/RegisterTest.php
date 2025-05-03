<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    protected string $url = '/register';

    // use RefreshDatabase;

    public function test_1_名前が未入力の場合はバリデーションメッセージが表示される()
    {
        $response = $this->from('/register')->post('/register', [
            // intentionally omit 'name'
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Fortifyはバリデーションエラー時に302でリダイレクト
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name']);

        $this->followRedirects($response)->assertSee('お名前を入力してください');
    }

    public function test_2_メールアドレスが未入力の場合はバリデーションメッセージが表示される(): void
    {
        $response = $this->from('/register')->post('/register', [
            // intentionally omit 'name'
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Fortifyはバリデーションエラー時に302でリダイレクト
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name']);

        $this->followRedirects($response)->assertSee('お名前を入力してください');

        $response = $this->from('/register')->post('/register', [
            'name' => 'テストユーザー',
            'email' => '', // メールアドレス未入力
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // バリデーションエラーがセッションに含まれているか確認
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email']);

        // メッセージが表示されることを確認
        $this->followRedirects($response)
            ->assertSee('メールアドレスを入力してください');
    }

    public function test_3_パスワードが未入力の場合はバリデーションメッセージが表示される(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        // バリデーションエラーがセッションに含まれているか確認（両方）
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password', 'password_confirmation']);

        // メッセージが表示されることを確認（両方）
        $this->followRedirects($response)->assertSee('パスワードを入力してください');
        // $this->followRedirects($response)->assertSee('確認用パスワードを入力してください');
    }

    public function test_4_パスワードが7文字以下の場合はバリデーションメッセージが表示される()
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'short7',
            'password_confirmation' => 'short7',
        ]);

        // バリデーションエラーがセッションに含まれているか確認（両方）
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password', 'password_confirmation']);

        // メッセージが表示されることを確認（両方）
        $this->followRedirects($response)->assertSee('パスワードは8文字以上で入力してください');
    }

    public function test_5_パスワードと確認用パスワードが一致しない場合はバリデーションメッセージが表示される()
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
        ]);

        // バリデーションエラーがセッションに含まれているか確認
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);

        // メッセージが表示されることを確認（両方）
        $this->followRedirects($response)->assertSee('パスワードと一致しません');
    }

    public function test_6_全ての項目が正しければユーザー登録されログイン画面に遷移する()
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // リダイレクト先の確認（Fortifyの仕様上）
        $response->assertRedirect('/email/verify');

        // 登録されたユーザーがDBに存在するか確認
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
        ]);

        // 登録されたユーザーを取得して更新
        $user = \App\Models\User::where('email', 'user@example.com')->firstOrFail();
        $user->email_verified_at = now();
        $user->is_first_login = true;
        $user->save();
    }
}
