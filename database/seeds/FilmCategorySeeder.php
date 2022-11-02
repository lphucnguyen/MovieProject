<?php

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
        //
        // $filmCategories = [
        //     [
        //         'film_id' => '1',
        //         'category_id' => '1',
        //     ],
        //     [
        //         'film_id' => '1',
        //         'category_id' => '2',
        //     ],
        //     [
        //         'film_id' => '2',
        //         'category_id' => '1',
        //     ],
        // ];

        // foreach ($filmCategories as $filmCategory) {
        //     \Illuminate\Support\Facades\DB::table('film_category')->insert($filmCategory);
        // }

        // print_r(Film::all());

        Film::chunk(1000, function($films){
            foreach($films as $film){
                $categories = Category::select('id')
                    ->inRandomOrder()
                    ->limit(2)
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

        // Film::all()->chunk(1000, function($films){
        //     foreach($films as $film){
        //         $categories = Category::select('id')
        //             ->inRandomOrder()
        //             ->limit(2)
        //             ->get()
        //             ->toArray();
        
        //         $idCategories = array_map(function ($category) {
        //             return $category['id'];
        //         }, $categories);

        //         $film->categories()->attach(
        //             $idCategories
        //         );
        //     }
        // });
    }
}
