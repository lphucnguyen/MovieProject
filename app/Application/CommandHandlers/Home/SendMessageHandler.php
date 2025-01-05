<?php

namespace App\Application\CommandHandlers\Home;

use App\Application\Commands\Home\SendMessageCommand;
use App\Domain\Repositories\IMessageRepository;

class SendMessageHandler
{
    public function __construct(
        private IMessageRepository $repository
    ) {
    }

    public function handle(SendMessageCommand $command)
    {
        $this->repository->create(
            $command->data->toArray()
        );
    }
}
