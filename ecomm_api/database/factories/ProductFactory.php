<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'sku' =>$faker->isbn13,
        'name' =>$faker->word,
        'price' =>$faker->number,
        'description' =>$faker->paragraph,
        'image' =>$faker->image,
        'active'   =>$faker->boolval,
        'quantity' =>$faker->number,
    ];
});
