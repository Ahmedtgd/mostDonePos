<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string ('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('name');
            $table->string('quantity');
            $table->text('description');
            $table->decimal('price');
            $table->string('file');
            $table->string('fil');
            $table->timestamps();
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('quantity');
            $table->string('status');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deliveryStatus');
            $table->string('vehicle');
     //     $table->string('quantity_selected');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('product2_id')->unsigned();
            $table->foreign('product2_id')->references('id')->on('products');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           
            
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('category_description');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('vehicle_number');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();
        });

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
               
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            
            ]);

            DB::table('customers')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
          
            DB::table('products')->insert([
                'id' => $faker->randomElement(['open', 'closed']),
                'name'  => $faker->randomElement(['car', 'bike', 'truck']),
                'quantity'=> $faker->numberBetween($min = 1, $max = 10),
                'description' => $faker->randomElement(['car', 'bike', 'truck']),
                'price' => $faker->numberBetween($min = 1, $max = 10),
            ]);

            DB::table('cards')->insert([
                'status' => $faker->randomElement(['open', 'closed']),
                'product_id' => $faker->numberBetween($min = 1, $max = 10),
                'customer_id' => $i,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]); 
            DB::table('categories')->insert([
                'category_name' => $faker->randomElement(['car', 'bike', 'truck']),
                'category_description'  => $faker->randomElement(['car', 'bike', 'truck']),
                'product_id' => $faker->numberBetween($min = 1, $max = 10),
                'customer_id' => $i,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('orders')->insert([
                'deliveryStatus' => $faker->randomElement(['delivered', 'pending', 'dispatched']),
                'vehicle' => $faker->randomElement(['car', 'bike', 'truck']),
          //    'quantity_selected' => $faker->numberBetween($min = 1, $max = 10),
                'customer_id' => $i,
                'user_id' => $i,
                'product_id' => $faker->numberBetween($min = 1, $max = 10),
                'product2_id' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('vehicles')->insert([
                'status' => $faker->randomElement(['available', 'busy']),
                'vehicle_number' => $faker->numberBetween($min = 1000, $max = 9999),
                'order_id' => $i,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('products');
    }
}