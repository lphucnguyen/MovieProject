<?php

namespace App\Domain\Repositories;

interface IReviewRepository extends IRepository
{
    public function getReviewByQueryParams(array $queryParams);
}
