<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Episode::class, 1000)->create();
        $episodes = [
            [
                'id'   => str()->uuid(),
                'film_id' => \App\Domain\Models\Film::all()->random()->id,
                'url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4',
                'api_url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4'
            ],
            [
                'id'   => str()->uuid(),
                'film_id' => \App\Domain\Models\Film::all()->random()->id,
                'url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4',
                'api_url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4'
            ],
            [
                'id'   => str()->uuid(),
                'film_id' => \App\Domain\Models\Film::all()->random()->id,
                'url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4',
                'api_url' => 'https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4'
            ]
        ];

        foreach ($episodes as $episode) {
            \App\Domain\Models\Episode::create($episode);
        }
    }
}
