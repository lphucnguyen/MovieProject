<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface IActorRepository extends IRepository
{
    public function getFilms(string $uuid);

    public function getActorsByQueryParams(array $queryParams);
}
