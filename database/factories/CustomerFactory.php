<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'address' => $faker->address(),
        'phone_number' => $faker->phoneNumber(),
        'comments' => $faker->text($maxNbChars = 500),
        'rating' => $faker->numberBetween($min = 0, $max = 5),
        'status' => "Not Done"
    ];
});
