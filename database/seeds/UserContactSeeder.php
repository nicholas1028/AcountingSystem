<?php

use Illuminate\Database\Seeder;

class UserContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\UserContact::class,200)->create();
    }
}
