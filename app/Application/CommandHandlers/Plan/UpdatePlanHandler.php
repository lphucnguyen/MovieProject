<?php

namespace App\Application\CommandHandlers\Plan;

use App\Application\Commands\Plan\UpdatePlanCommand;
use App\Domain\Repositories\IPlanRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdatePlanHandler
{
    public function __construct(
        public IPlanRepository $repository
    ) {
    }

    public function handle(UpdatePlanCommand $command)
    {
        try {
            DB::beginTransaction();

            $this->repository->update($command->uuid, [
                'price' => $command->price,
                'slug' => $command->slug
            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error("Update Plan error: " . $e->getMessage());
        }
    }
}
