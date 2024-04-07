<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IReviewRepository;
use App\Services\BaseService;
use App\Services\IService;

class ReviewService extends BaseService implements IService
{
    public function __construct(IReviewRepository $repository)
    {
        parent::__construct($repository);
    }
}
