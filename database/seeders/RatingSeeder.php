<?php

namespace Database\Seeders;

use App\Film;
use App\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
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
                    $rating = new \App\Rating();
                    $rating->user_id = $user['id'];
                    $rating->film_id = $film->id;
                    $rating->rating = rand(1, 5);

                    return $rating;
                }, $users);

                $film->ratings()->saveMany($ratings);
            }
        });
    }
}
