<?php

namespace Database\Seeders;

use App\User;
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
        factory(User::class, 100)
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
