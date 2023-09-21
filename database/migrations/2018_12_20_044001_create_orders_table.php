<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('deliveryStatus');
            $table->string('vehicle');
            $table->string('Product1_quantity')->nullable();
            $table->string('Product2_quantity')->nullable();
            $table->string('product_details')->nullable();
            $table->unsignedBigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->nullable();
            $table->unsignedBigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullable();
            $table->unsignedBigInteger('product2_id')->unsigned()->nullable();
            $table->foreign('product2_id')->references('id')->on('products')->nullable();
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
