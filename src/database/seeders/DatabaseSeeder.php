<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProfSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CategoryProductSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
