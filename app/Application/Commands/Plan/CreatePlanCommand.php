<?php

namespace App\Application\Commands\Plan;

class CreatePlanCommand
{
    public function __construct(
        public string $slug,
        public int $amount
    ) {
    }
}
