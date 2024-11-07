<?php

namespace App\Observers;

use App\Film;
use App\Neo4j\Connection;
use Illuminate\Support\Facades\Storage;

class FilmObserver
{
    public function creating(Film $model)
    {
        $model->id = str()->uuid();
    }

    public function created(Film $model)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $fileNameOfBackgoudCover = basename($film->background_cover);
        // $fileNameOfPoster = basename($film->poster);
        // $query = 'CREATE (f:Films{
        //                 id: $filmId,
        //                 background_cover: "/film_background_covers/' . $fileNameOfBackgoudCover . '",
        //                 name: "' . $film->name . '",
        //                 overview: "' . $film->overview . '",
        //                 poster: "/film_posters/' . $fileNameOfPoster . '"
        //             })';
        // $param = [
        //     'filmId' => $film->id,
        // ];
        // $client->run($query, $param);
    }

    public function updating(Film $model)
    {
        if ($model->isDirty('background_cover')) {
            Storage::delete($model->getRawOriginal('background_cover'));
        }

        if ($model->isDirty('poster')) {
            Storage::delete($model->getRawOriginal('poster'));
        }
    }

    public function updated(Film $model)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $fileNameOfBackgoudCover = basename($film->background_cover);
        // $fileNameOfPoster = basename($film->poster);
        // $query = 'MATCH (f:Films{id: $filmId})
        //             SET f.background_cover="/film_background_covers/' . $fileNameOfBackgoudCover . '",
        //                 f.name="' . $film->name . '",
        //                 f.overview="' . $film->overview . '",
        //                 f.poster="/film_posters/' . $fileNameOfPoster . '"';
        // $param = [
        //     'filmId' => $film->id
        // ];
        // $client->run($query, $param);
    }

    public function deleting(Film $model)
    {
        $attributes = $model->getAttributes();

        Storage::delete($attributes['background_cover']);
        Storage::delete($attributes['poster']);
    }

    public function deleted(Film $model)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (f:Films{id: $filmId})
        //             DETACH DELETE f';
        // $param = [
        //     'filmId' => $film->id,
        // ];
        // $client->run($query, $param);
    }
}
