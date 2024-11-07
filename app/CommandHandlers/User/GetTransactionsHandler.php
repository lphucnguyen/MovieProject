<?php

namespace App\CommandHandlers\User;

use App\Commands\User\GetTransactionsCommand;
use App\Repositories\Contracts\IUserRepository;

class GetTransactionsHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetTransactionsCommand $command)
    {
        return $this->repository->getTransactions($command->uuid);
    }
}
