<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // factory(User::class, 100)
        //     ->create();
            // ->each(function ($user) {
            //     $films = Film::select('id')
            //             ->inRandomOrder()
            //             ->limit(50)
            //             ->get()
            //             ->toArray();

            //     $idFilms = array_map(function ($film) {
            //         return $film['id'];
            //     }, $films);

            //     $user->rated_films()->attach(
            //         $idFilms ,
            //         [
            //             'rating' => rand(1,5)
            //         ]
            //     );
            // });

        $users = [
            [
                'id'   => str()->uuid(),
                'username' => 'testUser1',
                'first_name' => 'testUser1',
                'last_name' => 'testUser1',
                'email' => 'testUser1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'),
                'remember_token' => str()->random(10),
            ],
            [
                'id'   => str()->uuid(),
                'username' => 'testUser2',
                'first_name' => 'testUser2',
                'last_name' => 'testUser2',
                'email' => 'testUser2@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'),
                'remember_token' => str()->random(10),
            ],
            [
                'id'   => str()->uuid(),
                'username' => 'testUser3',
                'first_name' => 'testUser3',
                'last_name' => 'testUser3',
                'email' => 'testUser3@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456'),
                'remember_token' => str()->random(10),
            ]
        ];

        foreach ($users as $user) {
            \App\Domain\Models\User::create($user);
        }
    }
}
