<?php

use Illuminate\Database\Seeder;

class PartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert([
            ['name' => 'ビス', 'supplier_id' => 1, 'created_user_id' => 1, 'updated_user_id' => 1],
            ['name' => 'ナット', 'supplier_id' => 1, 'created_user_id' => 1, 'updated_user_id' => 1]
        ]);
    }
}