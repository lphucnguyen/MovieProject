<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\CreateMovieCommand;
use App\Domain\Repositories\IFilmRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(CreateMovieCommand $command)
    {
        try {
            DB::beginTransaction();
            $data = $command->data;

            $parts = explode("/", $data->poster);
            $file = implode('/', array_slice($parts, -2));
            $data->poster = $file;

            $parts = explode("/", $data->background_cover);
            $file = implode('/', array_slice($parts, -2));
            $data->background_cover = $file;

            $data->overview = strip_tags($data->overview, config('app.allowTags'));

            // Insert film
            $film = $this->repository->create($data->toArray());

            // Insert categories and actors
            $film->categories()->sync($data->categories);
            $film->actors()->sync($data->actors);

            // Insert episodes
            $id = $film->id;
            $episodes = array_map(function ($url, $apiUrl) use ($id) {
                return [
                    'id' => str()->uuid(),
                    'url' => $url ? $url : '',
                    'api_url' => $apiUrl ? $apiUrl : '',
                    'film_id' => $id
                ];
            }, $data->url, $data->api_url);

            $film->episodes()->insert($episodes);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
