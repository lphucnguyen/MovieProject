<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface IReviewRepository extends IRepository
{
    public function getReviewByQueryParams(array $queryParams);
}
