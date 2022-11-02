<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Film;
use App\Membership;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

$factory->define(Film::class, function (Faker $faker) {
    // $faker = \Faker\Factory::create();
    // $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    // $faker->addProvider(new \Mmo\Faker\LoremSpaceProvider($faker));

    // return [
    //     'name' => $faker->name,
    //     'year' => $faker->numberBetween(1996, 2020),
    //     'overview' => $faker->text('255'),
    //     'is_free' => false,
    //     'background_cover' => 'film_background_covers/' . $faker->picsum('public/storage/film_background_covers', 640,480, null, false),
    //     'poster' => 'film_posters/' . $faker->picsum('public/storage/film_posters', 640,480, null, false)
    // ];
    
    $directory = 'film_background_covers';
    $files = Storage::allFiles($directory);
    $randomFileBackground = $files[rand(0, count($files) - 1)];

    $directory = 'film_posters';
    $files = Storage::allFiles($directory);
    $randomFilePoster = $files[rand(0, count($files) - 1)];

    return [
        'name' => $faker->unique()->name,
        'year' => $faker->numberBetween(1996, 2020),
        'overview' => $faker->text('255'),
        'is_free' => false,
        'background_cover' => 'film_background_covers/' . $randomFileBackground,
        'poster' => 'film_posters/' . $randomFilePoster
    ];
});
