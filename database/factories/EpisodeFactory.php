<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Models\Film;
use App\Domain\Models\Episode;
use Faker\Generator as Faker;

$factory->define(Episode::class, function (Faker $faker) {
    return [
        'id'   => str()->uuid(),
        'film_id' => Film::all()->random()->id,
        'url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4',
        'api_url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4'
    ];
});
