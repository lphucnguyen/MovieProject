<?php

namespace App\Application\CommandHandlers\Subscription;

use App\Application\Commands\Subscription\GetSubscriptionCommand;
use App\Domain\Repositories\ISubscriptionRepository;

class GetSubscriptionHandler
{
    public function __construct(
        public ISubscriptionRepository $repository
    ) {
    }

    public function handle(GetSubscriptionCommand $command)
    {
        return $this->repository->get($command->uuid);
    }
}
