<?php

namespace App\Application\CommandHandlers\Subscription;

use App\Application\Commands\Subscription\UpdateSubscriptionCommand;
use App\Domain\Repositories\ISubscriptionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateSubscriptionHandler
{
    public function __construct(
        public ISubscriptionRepository $repository
    ) {
    }

    public function handle(UpdateSubscriptionCommand $command)
    {
        try {
            DB::beginTransaction();

            $this->repository->update($command->uuid, [
                'active_until' => $command->activeUntil
            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
        }
    }
}
