<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface ICategoryRepository extends IRepository
{
    public function getCategoriesByQueryParams(array $queryParams);

    public function getLatestCategoriesWithFilms(int $limitCategory, int $limitFilm);
}
