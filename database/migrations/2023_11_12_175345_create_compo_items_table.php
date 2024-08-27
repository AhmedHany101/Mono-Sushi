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
        Schema::create('compo_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('compo_id');
            $table->integer('pieces_no');
            $table->decimal('pieces_price',8,2)->nullable();
            $table->decimal('total',8,2);
            $table->integer('qty');
            $table->foreign('compo_id')->references('id')->on('compos')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('dishes_datas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compo_items');
    }
};
