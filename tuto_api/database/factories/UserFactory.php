<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'pseudo' => $faker->firstName($gender = 'male'|'female'),
        'bio' => $faker->sentence($nbWords = 6, $variableNbWords = true) ,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'city' => $faker->city,
        'country' => $faker->country,
        'zipcode' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'password', // password
    ];
});
