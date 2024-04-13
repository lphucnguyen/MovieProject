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
                ->paginate($this->perPage);
    }
}
