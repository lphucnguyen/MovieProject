<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IRatingRepository;
use App\Services\BaseService;
use App\Services\IService;

class RatingService extends BaseService implements IService
{
    public function __construct(IRatingRepository $repository)
    {
        parent::__construct($repository);
    }
}
