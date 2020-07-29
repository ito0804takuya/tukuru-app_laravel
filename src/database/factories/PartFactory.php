<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Part;
use Faker\Generator as Faker;

$factory->define(Part::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'supplier_id' => $faker->randomDigit(),
        'created_user_id' => $faker->randomDigit(),
        'updated_user_id' => null
    ];
});
