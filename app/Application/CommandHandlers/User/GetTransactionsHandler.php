<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetTransactionsCommand;
use App\Domain\Repositories\IUserRepository;

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
