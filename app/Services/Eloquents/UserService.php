<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IUserRepository;
use App\Services\BaseService;
use App\Services\IService;

class UserService extends BaseService implements IService
{
    public function __construct(IUserRepository $repository)
    {
        parent::__construct($repository);
    }
}
