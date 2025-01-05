<?php

namespace Database\Seeders;

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
        \App\Domain\Models\Film::chunk(1000, function ($films) {
            foreach ($films as $film) {
                $users = \App\Domain\Models\User::select('id')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get()
                    ->toArray();

                $ratings = array_map(function ($user) use ($film) {
                    $rating = new \App\Domain\Models\Favorite();
                    $rating->id = str()->uuid();
                    $rating->user_id = $user['id'];
                    $rating->film_id = $film->id;

                    return $rating;
                }, $users);

                $film->favorites()->saveMany($ratings);
            }
        });
    }
}
