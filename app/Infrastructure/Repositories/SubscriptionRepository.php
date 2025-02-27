<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Subscription;
use App\Domain\Repositories\ISubscriptionRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;
use Illuminate\Pipeline\Pipeline;

class SubscriptionRepository extends BaseRepository implements ISubscriptionRepository
{
    public function __construct(
        Subscription $model
    ) {
        parent::__construct($model);
    }

    public function getSubscriptionsByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return app(Pipeline::class)
            ->send($query)
            ->through([
                new \App\Infrastructure\QueryFilters\Subscription\FilterBySlug($queryParams),
                new \App\Infrastructure\QueryFilters\Subscription\FilterByUserName($queryParams),
            ])
            ->thenReturn()
            ->with('user:id,username,last_name,first_name')
            ->with('plan:id,slug')
            ->latest()
            ->paginate(config('app.perPage'));
    }

    public function getSubscriptionByUserId(string $userId) {
        return $this->makeQuery()
            ->where('user_id', $userId)
            ->with('plan:id,slug')
            ->first();
    }
}