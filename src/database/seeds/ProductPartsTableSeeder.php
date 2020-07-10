<?php

use Illuminate\Database\Seeder;

class ProductPartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_parts')->insert([
            ['product_id' => 1, 'part_id' => 1]
        ]);
    }
}
