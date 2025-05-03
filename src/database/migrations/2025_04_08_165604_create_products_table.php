<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 商品名
            $table->string('brand')->nullable(); // ブランド名
            $table->integer('price')->nullable(); // 金額
            $table->text('description')->nullable(); // 商品説明
            $table->unsignedBigInteger('condition_id')->nullable(); // 商品状態
            $table->string('image_path')->nullable(); // 商品画像
            $table->boolean('is_sold')->default(false); // 売却済みフラグ
            $table->unsignedBigInteger('user_id'); // 出品者（User外部キー）
            $table->timestamps();

            $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
