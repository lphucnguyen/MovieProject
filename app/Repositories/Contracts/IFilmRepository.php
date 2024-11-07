<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface IFilmRepository extends IRepository
{
    public function getFilmByCategoryName($categoryName);

    public function getReviews($uuidMovie);

    public function getFilmsByQueryParams(array $queryParams);
}
