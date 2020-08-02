<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Part;
use App\User;
use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Part::class, function (Faker $faker) {
    $userCount = User::all()->count();
    $supplierCount = Supplier::all()->count();
    
    return [
        'name' => $faker->word(),
        'supplier_id' => $faker->numberBetween(1, $supplierCount),
        'created_user_id' => $faker->numberBetween(1, $userCount),
        'updated_user_id' => null
    ];
});
