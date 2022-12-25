<?php

use App\Category;
use App\Film;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FilmSeeder extends Seeder
{
    public function generateMembershipsCanSee() {
        $randomMemberships = \App\Membership::select('id')
                            ->inRandomOrder()
                            ->limit(2)
                            ->get()
                            ->toArray();
        $randomMemberships = array_map(function($membership) {
        return $membership['id'];
        }, $randomMemberships);
        $randomMembershipsString = implode(',', $randomMemberships);
        
        return $randomMembershipsString;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Film::class, 15)->create();

        // for($i=0 ; $i< 10 ; $i++){
        //     $films = factory(App\Film::class, 100)->make()->toArray();
        //     $membershipCanSeeString = $this->generateMembershipsCanSee();

        //     $films = array_map(function($film) use($membershipCanSeeString) {
        //         $film['background_cover'] = 'film_background_covers/' . basename($film['background_cover']);
        //         $film['poster'] = 'film_posters/' . basename($film['poster']);
        //         $film['memberships_can_see'] = $membershipCanSeeString;
        //         return $film;
        //     }, $films);

        //     // $chunks = $films->chunk(100);
        //     $chunks = array_chunk($films, 100);
        //     foreach ($chunks as $chunk) {
        //         Film::insert($chunk);
        //     }
        // }
        
        $directory = 'files';
        $files = Storage::files($directory);
        foreach($files as $file){
            $content = Storage::get($file);
            $films = json_decode($content, true);
            // foreach ($films as $film) {
            //     $film['name'] = $film['title'];
            //     unset($film['title']);
            //     dd($film);
            // }
            $films_map = array_map(function($film) {
                return [
                    'name' => $film['title'], 
                    'year' => $film['year'], 
                    'overview' => $film['overview'],
                    'poster' => $film['poster'],
                    'background_cover' => $film['background_cover'],
                    'is_free' => $film['is_free'],
                ];
            }, $films);
            // dd($films);

            $chunks = array_chunk($films_map, 50);
            foreach ($chunks as $chunk) {
                Film::insert($chunk);
            }
        }
    }
}
