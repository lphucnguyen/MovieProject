<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Admin::create([
            'id'        => str()->uuid(),
            'name'      => 'Super Admin',
            'email'     => 'super_admin@app.com',
            'password'  => bcrypt('123456')
        ]);

        $admin->attachRole('super_admin');
    }
}
