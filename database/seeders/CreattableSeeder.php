<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use App\Models\Card;
use App\Models\Category;
use App\Models\Order;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CreattableSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $faker = Faker::create();
         // Generate fake product data

         for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->word,
                'email' => $faker->sentence,
                'password' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                
            ]);
            
        }

         for ($i = 0; $i < 10; $i++) {
            Category::create([
                'category_name' =>$faker->word,
               'category_description' =>$faker->word
                     ]);
            
        }
        for ($i = 0; $i < 10; $i++) {
            $category = Category::inRandomOrder()->first();
            Product::create([
                'name'=> $faker->word,
                'quantity'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 0),
                'description' => $faker->sentence,
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                'file' => $faker->imageUrl(),
                'fil' => $faker->imageUrl(),
                'category_id' => $category->id,
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Customer::create([
                'name' => $faker->word,
                'email' => $faker->sentence,
                'password' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                'phone' =>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                'address' => $faker->sentence,
            ]);
            
        }

        for ($i = 0; $i < 10; $i++) {
            $product = Product::inRandomOrder()->first();
            $product2 = Product::inRandomOrder()->first();
            $customer = Customer::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();


            Order::create([
                'deliveryStatus' => $faker->sentence,
                'vehicle' =>$faker->word,
                'product2_id' => $product2->id,
                'customer_id' => $customer->id,
                'user_id' => $user->id
             // 'quantity_selected' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100)
            ]);
            
        }
     
      
       }
}
