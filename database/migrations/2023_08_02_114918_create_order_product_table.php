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
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('quantity');

        Schema::dropIfExists('order_product');
    }
};
