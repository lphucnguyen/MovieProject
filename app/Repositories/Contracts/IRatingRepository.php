<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface IRatingRepository extends IRepository
{
    public function getRatingsByQueryParams(array $queryParams);
}
