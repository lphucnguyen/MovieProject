<?php

namespace Database\Seeders;

use App\Film;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film::chunk(1000, function ($films) {
            foreach ($films as $film) {
                $users = \App\User::select('id')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get()
                    ->toArray();

                $ratings = array_map(function ($user) use ($film) {
                    $rating = new \App\Favorite();
                    $rating->user_id = $user['id'];
                    $rating->film_id = $film->id;

                    return $rating;
                }, $users);

                $film->favorites()->saveMany($ratings);
            }
        });
    }
}
