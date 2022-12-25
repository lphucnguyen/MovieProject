<?php

use App\Film;
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
        //
        // $users = [
        //     [
        //         'username' => 'UserName',
        //         'first_name' => 'FirstName',
        //         'last_name' => 'LastName',
        //         'email' => 'user@app.com',
        //         'password' => bcrypt(123456),
        //         'membership_id' => \App\Membership::all()->random()->id,
        //     ],
        //     [
        //         'username' => 'user2',
        //         'first_name' => 'user2',
        //         'last_name' => 'user2',
        //         'email' => 'user2@app.com',
        //         'password' => bcrypt(123456),
        //         'membership_id' => \App\Membership::all()->random()->id,
        //     ]
        // ];

        // foreach ($users as $user) {
        //     \App\User::create($user);
        // }

        factory(App\User::class, 100)
            ->create();
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

    }
}
