<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FilmCategorySeeder extends Seeder
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
                $categories = \App\Domain\Models\Category::select('id')
                    ->inRandomOrder()
                    ->limit(3)
                    ->get()
                    ->toArray();

                $idCategories = array_map(function ($category) {
                    return $category['id'];
                }, $categories);

                $film->categories()->attach(
                    $idCategories
                );
            }
        });
    }
}
