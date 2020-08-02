<?php

use App\Part;
use App\Product;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('parts')->truncate();
        DB::table('product_parts')->truncate();

        factory(Part::class, 10)->create();
        $parts = Part::all();

        // 商品を、1~3つの部品と紐付けて登録
        factory(Product::class, 10)->create()
            ->each(function ($product) use ($parts) {
                $product->parts()->attach($parts->random(rand(1,3))->pluck('id')->toArray());
            });
    }
}
