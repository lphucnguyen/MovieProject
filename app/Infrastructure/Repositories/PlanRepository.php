<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Plan;
use App\Domain\Repositories\IPlanRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class PlanRepository extends BaseRepository implements IPlanRepository
{
    public function __construct(
        Plan $model
    ) {
        parent::__construct($model);
    }
}