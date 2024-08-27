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
        Schema::create('order_item_pices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_item_id');
            $table->decimal('product_price', 8, 2);
            $table->integer('product_pieces');
            $table->decimal('total', 8, 2);
            $table->foreign('product_id')->references('id')->on('dishes_datas')->onDelete('cascade');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_pices');
    }
};
