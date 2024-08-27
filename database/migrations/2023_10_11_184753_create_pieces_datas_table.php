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
        Schema::create('pieces_datas', function (Blueprint $table) {
            $table->id();
            $table->integer('pieces_no');
            $table->integer('pieces_price');
            $table->bigInteger('dish_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces_datas');
    }
};
