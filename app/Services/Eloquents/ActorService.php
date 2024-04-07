<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IActorRepository;
use App\Services\BaseService;
use App\Services\IService;

class ActorService extends BaseService implements IService
{
    public function __construct(IActorRepository $repository)
    {
        parent::__construct($repository);
    }
}
