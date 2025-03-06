<?php

namespace Database\Seeders;

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
        \App\Domain\Models\Film::chunk(1000, function ($films) {
            foreach ($films as $film) {
                $users = \App\Domain\Models\User::select('id')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get()
                    ->toArray();

                $ratings = array_map(function ($user) use ($film) {
                    $rating = new \App\Domain\Models\Rating();
                    $rating->id = str()->uuid();
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
