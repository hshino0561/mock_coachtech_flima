<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'buyer_id' => '2',
            'item_id' => '2',
            'price' => '5000',
            'delivery_postal_code' => '222-2222',
            'delivery_address' => '埼玉県',
            'delivery_building' => 'プラザ3',
            'payment_method' => 'カード支払い',
        ]);
    }
}
