<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IMessageRepository;
use App\Services\BaseService;
use App\Services\IService;

class MessageService extends BaseService implements IService
{
    public function __construct(IMessageRepository $repository)
    {
        parent::__construct($repository);
    }
}
