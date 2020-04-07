<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'sku' =>$faker->word,
        'name' =>$faker->word,
        'price' =>$faker->number,
        'description' =>$faker->sentance,
        'image' =>$faker->word,
        'active'   =>$faker->boolval,
        'quantity' =>$faker->number,
    ];
});
