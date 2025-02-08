<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Repositories\IRepository;

interface IActorRepository extends IRepository
{
    public function getFilms(string $uuid);

    public function getActorsByQueryParams(array $queryParams);
}
