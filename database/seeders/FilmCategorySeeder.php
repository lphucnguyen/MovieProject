<?php

namespace Database\Seeders;

use App\Category;
use App\Film;
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
        Film::chunk(1000, function ($films) {
            foreach ($films as $film) {
                $categories = Category::select('id')
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
