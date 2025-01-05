<?php

namespace App\Application\CommandHandlers\Message;

use App\Application\Commands\Message\DeleteMessageCommand;
use App\Domain\Repositories\IMessageRepository;

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
