<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Film;
use App\Rating;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    $idUser = User::select('id')
        ->inRandomOrder()
        ->limit(1)
        ->get()[0]
        ->id;
    $idFilm = Film::select('id')
        ->inRandomOrder()
        ->limit(1)
        ->get()[0]
        ->id;

    return [
        'id'   => str()->uuid(),
        'user_id' => $idUser,
        'film_id' => $idFilm,
        'rating' => rand(1, 5)
    ];
});
