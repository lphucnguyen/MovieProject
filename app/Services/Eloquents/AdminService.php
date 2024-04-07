<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IAdminRepository;
use App\Services\BaseService;
use App\Services\IService;

class AdminService extends BaseService implements IService
{
    public function __construct(IAdminRepository $repository)
    {
        parent::__construct($repository);
    }
}
