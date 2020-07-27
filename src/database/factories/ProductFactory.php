<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'product_code' => $faker->randomLetter(10),
        'image' => $faker->image($dir = '/tmp'),
        'created_user_id' => $faker->randomDigit(),
        'updated_user_id' => null
    ];
});
