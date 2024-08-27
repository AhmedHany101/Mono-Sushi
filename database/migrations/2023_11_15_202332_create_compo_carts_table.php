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
        Schema::create('compo_carts', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key column named 'id'
            $table->unsignedBigInteger('user_id'); // Creates an unsigned big integer column named 'user_id'
            $table->unsignedBigInteger('compo_id'); // Creates an unsigned big integer column named 'compo_id'
            $table->decimal('total', 8, 2)->nullable(); // Creates a decimal column named 'total' with precision 8 and scale 2. It allows for null values.
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns for recording the creation and modification timestamps

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('compo_id')->references('id')->on('compos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compo_carts');
    }
};
