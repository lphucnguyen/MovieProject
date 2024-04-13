<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IUserRepository;
use App\Services\BaseService;
use App\Services\Contracts\IUserService;

class UserService extends BaseService implements IUserService
{
    public function __construct(
        private IUserRepository $repository
    ) {
        parent::__construct($repository);
    }

    public function getTransactions($uuid)
    {
        return $this->repository->getTransactions($uuid);
    }
}
