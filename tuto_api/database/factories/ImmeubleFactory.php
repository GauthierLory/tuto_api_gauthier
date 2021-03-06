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
        'address' => $faker->address,
        'name' => $faker->catchPhrase,
        'code_im' => $faker->ean8,
        'code_soc' => $faker->ean8,
    ];
});
