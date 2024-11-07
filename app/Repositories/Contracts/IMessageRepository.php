<?php

namespace App\Repositories\Contracts;

use App\Repositories\IRepository;

interface IMessageRepository extends IRepository
{
    public function getMessagesByQueryParams(array $params);
}
