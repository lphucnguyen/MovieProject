<?php

namespace App\Domain\Repositories;

interface IMessageRepository extends IRepository
{
    public function getMessagesByQueryParams(array $params);
}
