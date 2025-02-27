<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Repositories\IRepository;

interface ISubscriptionRepository extends IRepository
{
    public function getSubscriptionsByQueryParams(array $queryParams);

    public function getSubscriptionByUserId(string $userId);
}
