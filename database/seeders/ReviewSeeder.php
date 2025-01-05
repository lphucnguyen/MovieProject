<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
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

                $reviews = array_map(function ($user) {
                    $review = new \App\Domain\Models\Review();
                    $review->id = str()->uuid();
                    $review->user_id = $user['id'];
                    $review->title = fake()->sentence(3);
                    $review->review = fake()->paragraph(2);

                    return $review;
                }, $users);

                $film->reviews()->saveMany($reviews);
            }
        });
    }
}
