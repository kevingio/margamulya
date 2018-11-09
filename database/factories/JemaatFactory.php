<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Jemaat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dob' => $faker->dateTimeBetween('this week', '+6 days'),
        'anniversary' => $faker->dateTimeBetween('last week', '+6 days'),
        'address' => $faker->address
    ];
});
