<?php

use Illuminate\Database\Seeder;

class MembershipUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(App\MembershipUser::class, 10)->create();
    }
}
