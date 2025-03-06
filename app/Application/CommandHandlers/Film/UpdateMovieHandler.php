<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\UpdateMovieCommand;
use App\Domain\Repositories\IFilmRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(UpdateMovieCommand $command)
    {
        try {
            DB::beginTransaction();
            $uuid = $command->uuid;
            $data = $command->data;
            $film = $this->repository->getWithLock($uuid);

            $parts = explode("/", $data->poster);
            $file = implode('/', array_slice($parts, -2));
            $data->poster = $file;

            $parts = explode("/", $data->background_cover);
            $file = implode('/', array_slice($parts, -2));
            $data->background_cover = $file;

            $data->overview = strip_tags($data->overview, config('app.allowTags'));

            $film->update($data->toArray());
            $film->categories()->sync($data->categories);
            $film->actors()->sync($data->actors);

            $id = $film->id;
            $episodes = array_map(function ($url, $apiUrl) use ($id) {
                return [
                    'id' => str()->uuid(),
                    'url' => $url ? $url : '',
                    'api_url' => $apiUrl ? $apiUrl : '',
                    'film_id' => $id
                ];
            }, $data->url, $data->api_url);

            $film->episodes()->delete();
            $film->episodes()->insert($episodes);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
