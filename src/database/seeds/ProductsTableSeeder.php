<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'エアコン', 'product_code' => 'SD-KNDJN', 'created_user_id' => 1, 'updated_user_id' => 1],
            ['name' => '洗濯機', 'product_code' => 'SD-KNDJN', 'created_user_id' => 1, 'updated_user_id' => 1],
            ['name' => '掃除機', 'product_code' => 'SD-KNDJN', 'created_user_id' => 1, 'updated_user_id' => 1],
        ]);
    }
}
