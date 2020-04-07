<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address1' => Str::random(10),
        'address2' => Str::random(10),
        'city' => Str::random(10) ,
        'state' => Str::random(10),
        'zip' => Str::random(10),
    ];
});


