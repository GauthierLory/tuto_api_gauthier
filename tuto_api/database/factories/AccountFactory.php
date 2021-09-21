<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Account;
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

$factory->define(Account::class, function (Faker $faker) {
    return [
        'content' => $faker->catchPhrase,
        'user_id' => function() {
            return factory(App\User::class)->make();
        },
        'immeuble_id' => function() {
            return factory(App\Immeuble::class)->make();
        },
        'created_at' => now(),
    ];
});