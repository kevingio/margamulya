<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->unique()->name,
        'username' => strtolower($faker->unique()->firstName) . '_' . strtolower($faker->lastName),
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});
