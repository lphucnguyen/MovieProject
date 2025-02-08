<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Repositories\IRepository;

interface ICategoryRepository extends IRepository
{
    public function getCategoriesByQueryParams(array $queryParams);

    public function getLatestCategoriesWithFilms(int $limitCategory, int $limitFilm);
}
