<?php

namespace App\Application\Commands\Plan;

class DeletePlanCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
