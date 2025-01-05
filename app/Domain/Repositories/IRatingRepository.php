<?php

namespace App\Domain\Repositories;

interface IRatingRepository extends IRepository
{
    public function getRatingsByQueryParams(array $queryParams);
}
