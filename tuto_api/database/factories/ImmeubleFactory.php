<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Immeuble;
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

$factory->define(Immeuble::class, function (Faker $faker) {
    return [
        'address' => $faker->name,
        'name' => $faker->name,
        'code_im' => $faker->name,
        'code_soc' => $faker->name,
    ];
});
