<?php

namespace App\Domain\Repositories;

interface IActorRepository extends IRepository
{
    public function getFilms(string $uuid);

    public function getActorsByQueryParams(array $queryParams);
}
