<?php

use Illuminate\Database\Seeder;

class ImmeubleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Immeuble::class, 10)->create();
    }
}
