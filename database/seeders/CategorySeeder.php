<?php

namespace Database\Seeders;

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
            ['id'        => str()->uuid(), 'name' => 'Hành động'],
            ['id'        => str()->uuid(), 'name' => 'Tình cảm'],
            ['id'        => str()->uuid(), 'name' => 'Hài hước'],
            ['id'        => str()->uuid(), 'name' => 'Kinh dị'],
            ['id'        => str()->uuid(), 'name' => 'Chiến tranh']
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
