<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Repositories\IRepository;

interface IMessageRepository extends IRepository
{
    public function getMessagesByQueryParams(array $params);
}
