<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Account::class, 20)->create()->each(function ($user, $immeuble){
            factory(App\User::class, 5)->create(['id' => $user->id]);
            factory(App\Immeuble::class, 5)->create(['id' => $immeuble->id]);
        });

        
    }
}
