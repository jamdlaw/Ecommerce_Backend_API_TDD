<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' =>$faker->isbn13,
        'name' =>$faker->word,
        'price' =>$faker->randomNumber(2),
        'description' =>$faker->paragraph,
        'image' =>$faker->image,
        'active'   =>$faker->boolean,
        'quantity' =>$faker->randomNumber(),
    ];
});
