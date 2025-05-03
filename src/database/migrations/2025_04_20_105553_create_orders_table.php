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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('products')->onDelete('cascade');
            $table->integer('price');
            $table->string('payment_method')->nullable();
            $table->string('delivery_postal_code')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_building');
            $table->timestamps();

            $table->unique(['buyer_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
