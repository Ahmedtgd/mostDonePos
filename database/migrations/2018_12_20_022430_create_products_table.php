<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string ('name');
            $table->string('quantity');
            $table->text('description');
            $table->decimal('price');
            $table->string('file')->nullable();
            $table->string('fil')->nullable();
            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullable();
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
        Schema::drop('products');
    }
}
