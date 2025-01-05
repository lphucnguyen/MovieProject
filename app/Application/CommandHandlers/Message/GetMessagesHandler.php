<?php

namespace App\Application\CommandHandlers\Message;

use App\Application\Commands\Message\GetMessagesCommand;
use App\Domain\Repositories\IMessageRepository;

class GetMessagesHandler
{
    public function __construct(
        private IMessageRepository $repository
    ) {
    }

    public function handle(GetMessagesCommand $command)
    {
        return $this->repository->getMessagesByQueryParams([
            'searchKey' => $command->searchKey
        ]);
    }
}
