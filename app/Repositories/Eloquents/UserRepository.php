<?php

namespace App\Repositories\Eloquents;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IUserRepository;
use App\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(
        protected User $model
    ) {
        parent::__construct($model);
    }

    public function getTransactions($uuid)
    {
        return $this->model
                ->where('id', $uuid)
                ->with('transactions')
                ->latest()
                ->paginate(config('app.perPage'));
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
}
