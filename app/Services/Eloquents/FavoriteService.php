<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IFavoriteRepository;
use App\Services\BaseService;
use App\Services\IService;

class FavoriteService extends BaseService implements IService
{
    public function __construct(IFavoriteRepository $repository)
    {
        parent::__construct($repository);
    }
}
