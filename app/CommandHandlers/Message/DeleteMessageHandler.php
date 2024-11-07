<?php

namespace App\CommandHandlers\Message;

use App\Commands\Message\DeleteMessageCommand;
use App\Repositories\Contracts\IMessageRepository;

class DeleteMessageHandler
{
    public function __construct(
        public IMessageRepository $repository
    ) {
    }

    public function handle(DeleteMessageCommand $command)
    {
        $this->repository->delete($command->uuid);
    }
}
