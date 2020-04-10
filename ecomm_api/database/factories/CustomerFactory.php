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
        'address1' => $faker->streetAddress,
        'address2' => $faker->buildingNumber,
        'city' => $faker->city ,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
    ];
});


