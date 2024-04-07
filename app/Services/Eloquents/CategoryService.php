<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\ICategoryRepository;
use App\Services\BaseService;
use App\Services\IService;

class CategoryService extends BaseService implements IService
{
    public function __construct(ICategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}
