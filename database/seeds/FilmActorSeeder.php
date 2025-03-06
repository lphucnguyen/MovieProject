<?php

use Illuminate\Database\Seeder;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Film::chunk(1000, function($films){
            foreach($films as $film){
                $actors = \App\Actor::select('id')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get()
                    ->toArray();
        
                $idActors = array_map(function ($category) {
                    return $category['id'];
                }, $actors);

                $film->actors()->attach(
                    $idActors
                );
            }
        });
    }
}
