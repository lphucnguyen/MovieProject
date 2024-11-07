<?php

namespace App\CommandHandlers\Home;

use App\Commands\Home\SendMessageCommand;
use App\Repositories\Contracts\IMessageRepository;

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
