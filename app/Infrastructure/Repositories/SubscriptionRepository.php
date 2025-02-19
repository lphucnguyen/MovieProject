<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Subscription;
use App\Domain\Repositories\ISubscriptionRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class SubscriptionRepository extends BaseRepository implements ISubscriptionRepository
{
    public function __construct(
        Subscription $model
    ) {
        parent::__construct($model);
    }
}