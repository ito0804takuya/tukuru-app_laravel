<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->truncate();
        factory(Supplier::class, 10)->create();
    }
}
