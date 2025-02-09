<?php

namespace App\Infrastructure\Repositories;


use App\Domain\Repositories\IUserRepository;
use App\Domain\Models\User;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(
        private User $model
    ) {
        parent::__construct($model);
    }

    public function getFavorites($uuid)
    {
        return $this->get($uuid)
                ->favorites()
                ->latest()
                ->paginate(config('app.perPage'));
    }

    public function getRatings($uuid)
    {
        return $this->get($uuid)
                ->ratings()
                ->latest()
                ->paginate(config('app.perPage'));
    }

    public function getReviews($uuid)
    {
        return $this->get($uuid)
                ->reviews()
                ->latest()
                ->paginate(config('app.perPage'));
    }

    public function getOrders($uuid)
    {
        return $this->get($uuid)
                ->orders()
                ->latest()
                ->paginate(config('app.perPage'));
    }
}
