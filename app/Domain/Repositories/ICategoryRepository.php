<?php

namespace App\Domain\Repositories;

interface ICategoryRepository extends IRepository
{
    public function getCategoriesByQueryParams(array $queryParams);

    public function getLatestCategoriesWithFilms(int $limitCategory, int $limitFilm);
}
