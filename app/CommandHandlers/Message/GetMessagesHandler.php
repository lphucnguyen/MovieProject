<?php

namespace App\CommandHandlers\Message;

use App\Commands\Message\GetMessagesCommand;
use App\Repositories\Contracts\IMessageRepository;

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
