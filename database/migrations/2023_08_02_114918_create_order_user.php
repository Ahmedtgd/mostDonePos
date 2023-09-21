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
        Schema::create('order_user', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('quantity');

        Schema::dropIfExists('order_user');
    }
};
