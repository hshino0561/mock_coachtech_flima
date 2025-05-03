<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->id(); // ID（主キー）
            $table->string('label'); // 商品状態ラベル（例: 新品・良好）
            $table->timestamps(); // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conditions');
    }
};
