<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $directory = 'files';
        $files = Storage::files($directory);

        foreach ($files as $file) {
            $content = Storage::get($file);
            $films = json_decode($content, true);

            $films_map = array_map(function ($film) {
                return [
                    'id' => str()->uuid(),
                    'name' => $film['title'],
                    'year' => $film['year'],
                    'overview' => $film['overview'],
                    'poster' => $film['poster'],
                    'background_cover' => $film['background_cover'],
                ];
            }, $films);

            $chunks = array_chunk($films_map, 50);

            foreach ($chunks as $chunk) {
                \App\Domain\Models\Film::insert($chunk);
            }
        }
    }
}
