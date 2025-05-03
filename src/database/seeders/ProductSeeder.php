<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // dd($products);
        $userId = 1; // 商品の出品者（仮ユーザーID）

        $products = [
            ['name' => '腕時計', 'brand' => 'テスト', 'image_path' => 'Armani+Mens+Clock.jpg', 'price' => 15000, 'description' => 'スタイリッシュなデザインのメンズ腕時計', 'condition_id' => 1],
            ['name' => 'HDD', 'brand' => 'テスト', 'image_path' => 'HDD+Hard+Disk.jpg', 'price' => 5000, 'description' => '高速で信頼性の高いハードディスク', 'condition_id' => 2],
            ['name' => '玉ねぎ3束', 'brand' => 'テスト', 'image_path' => 'iLoveIMG+d.jpg', 'price' => 300, 'description' => '新鮮な玉ねぎ3束のセット', 'condition_id' => 3],
            ['name' => '革靴', 'brand' => 'テスト', 'image_path' => 'Leather+Shoes+Product+Photo.jpg', 'price' => 4000, 'description' => 'クラシックなデザインの革靴', 'condition_id' => 4],
            ['name' => 'ノートPC', 'brand' => 'テスト', 'image_path' => 'Living+Room+Laptop.jpg', 'price' => 45000, 'description' => '高性能なノートパソコン', 'condition_id' => 1],
            ['name' => 'マイク', 'brand' => 'テスト', 'image_path' => 'Music+Mic+4632231.jpg', 'price' => 8000, 'description' => '高音質のレコーディング用マイク', 'condition_id' => 2],
            ['name' => 'ショルダーバッグ', 'brand' => 'テスト', 'image_path' => 'Purse+fashion+pocket.jpg', 'price' => 3500, 'description' => 'おしゃれなショルダーバッグ', 'condition_id' => 3],
            ['name' => 'タンブラー', 'brand' => 'テスト', 'image_path' => 'Tumbler+souvenir.jpg', 'price' => 500, 'description' => '使いやすいタンブラー', 'condition_id' => 4],
            ['name' => 'コーヒーミル', 'brand' => 'テスト', 'image_path' => 'Waitress+with+Coffee+Grinder.jpg', 'price' => 4000, 'description' => '手動のコーヒーミル', 'condition_id' => 1],
            ['name' => 'メイクセット', 'brand' => 'テスト', 'image_path' => '外出メイクアップセット.jpg', 'price' => 2500, 'description' => '便利なメイクアップセット', 'condition_id' => 2],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'brand' => $product['brand'],
                'image_path' => $product['image_path'],
                'price' => $product['price'],
                'description' => $product['description'],
                'is_sold' => $product['name'] === 'HDD', // HDDだけtrue、それ以外はfalse
                'user_id' => $userId,
                'condition_id' => $product['condition_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
