<?php

namespace App\Application\CommandHandlers\Subscription;

use App\Application\Commands\Subscription\DeleteSubscriptionCommand;
use App\Domain\Repositories\ISubscriptionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteSubscriptionHandler
{
    public function __construct(
        public ISubscriptionRepository $repository
    ) {
    }

    public function handle(DeleteSubscriptionCommand $command)
    {
        try {
            $this->repository->delete($command->uuid);
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
