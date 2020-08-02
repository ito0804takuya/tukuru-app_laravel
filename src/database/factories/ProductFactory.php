<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $userCount = User::all()->count();
    
    return [
        'name' => $faker->word(),
        'product_code' => $faker->regexify('[A-Z]{2}-[A-Z]{8}'),
        'image' => $faker->image($dir = '/tmp'),
        'created_user_id' => $faker->numberBetween(1, $userCount),
        'updated_user_id' => null
    ];
});
