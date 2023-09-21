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
        Schema::create('order_category', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('category_name');

        Schema::dropIfExists('order_category');
    }
};
