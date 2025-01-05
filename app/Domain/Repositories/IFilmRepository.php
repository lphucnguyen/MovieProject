<?php

namespace App\Domain\Repositories;

interface IFilmRepository extends IRepository
{
    public function getFilmByCategoryName($categoryName);

    public function getReviews($uuidMovie);

    public function getFilmsByQueryParams(array $queryParams);
}
