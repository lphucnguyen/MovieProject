<?php

namespace App\Observers;

use App\Film;
use App\Neo4j\Connection;

class FilmObserver
{
    /**
     * Handle the film "created" event.
     *
     * @param  \App\Film  $film
     * @return void
     */
    public function created(Film $film)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $fileNameOfBackgoudCover = basename($film->background_cover);
        $fileNameOfPoster = basename($film->poster);
        $query = 'CREATE (f:Films{
                        id: $filmId,
                        background_cover: "/film_background_covers/' . $fileNameOfBackgoudCover . '",
                        name: "' . $film->name . '",
                        overview: "' . $film->overview . '",
                        poster: "/film_posters/' . $fileNameOfPoster . '"
                    })';
        $param = [
            'filmId' => $film->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the film "updated" event.
     *
     * @param  \App\Film  $film
     * @return void
     */
    public function updated(Film $film)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $fileNameOfBackgoudCover = basename($film->background_cover);
        $fileNameOfPoster = basename($film->poster);
        $query = 'MATCH (f:Films{id: $filmId})
                    SET f.background_cover="/film_background_covers/' . $fileNameOfBackgoudCover . '",
                        f.name="' . $film->name . '",
                        f.overview="' . $film->overview . '",
                        f.poster="/film_posters/' . $fileNameOfPoster . '"';
        $param = [
            'filmId' => $film->id
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the film "deleted" event.
     *
     * @param  \App\Film  $film
     * @return void
     */
    public function deleted(Film $film)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (f:Films{id: $filmId})
                    DETACH DELETE f';
        $param = [
            'filmId' => $film->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the film "restored" event.
     *
     * @param  \App\Film  $film
     * @return void
     */
    public function restored(Film $film)
    {
        //
    }

    /**
     * Handle the film "force deleted" event.
     *
     * @param  \App\Film  $film
     * @return void
     */
    public function forceDeleted(Film $film)
    {
        //
    }
}
