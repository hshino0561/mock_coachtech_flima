<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prof;

class ProfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザー1
        Prof::create([
            'user_id' => '1',
            'postal_code' => '000-0000',
            'address' => '東京都',
            'building' => 'プラザ1',
            'avatar' => 'user1.jpg',
        ]);

        // ユーザー2
        Prof::create([
            'user_id' => '2',
            'postal_code' => '111-1111',
            'address' => '神奈川県',
            'building' => 'プラザ2',
            'avatar' => 'user2.jpg',
        ]);
    }
}
