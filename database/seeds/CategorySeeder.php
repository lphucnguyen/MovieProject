<?php

use App\Film;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['name' => 'Hành động'],
            ['name' => 'Tình cảm'],
            ['name' => 'Hài hước']
        ];

        foreach ($categories as $category) {
            \App\Category::create($category);
                // ->each(function ($category) {
                //     $films = Film::select('id')
                //             ->inRandomOrder()
                //             ->limit(10)
                //             ->get()
                //             ->toArray();
                    
                //     $idFilms = array_map(function ($film) {
                //         return $film['id'];
                //     }, $films);

                //     $category->films()->attach(
                //         $idFilms
                //     );
                // });
        }

    }
}
