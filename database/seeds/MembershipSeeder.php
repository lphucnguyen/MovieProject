<?php

use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $memberships = [
            [
                'title' => 'Basic',
                'description' => 'Basic Plan',
                'price' => '0',
                'time_expired' => '1000'
            ],
            [
                'title' => 'Prenium',
                'description' => 'Prenium Plan',
                'price' => '100000',
                'time_expired' => '1'
            ]
        ];

        foreach ($memberships as $membership) {
            \App\Membership::create($membership);
        }
    }
}
