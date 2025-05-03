<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ユーザー1
        User::create([
            'name' => 'tes1',
            'email' => 'tes1@tes.com',
            'password' => Hash::make('tes88888'),
            'email_verified_at' => Carbon::now(), // 現在時刻で認証済みにする
            'is_first_login' => true,             // 初回ログインフラグON
        ]);

        // ユーザー2
        User::create([
            'name' => 'tes2',
            'email' => 'tes2@tes.com',
            'password' => Hash::make('tes88888'),
            'email_verified_at' => Carbon::now(),
            'is_first_login' => true,
        ]);
    }
}
