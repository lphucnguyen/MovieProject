<?php

namespace App\Application\Commands\Plan;

class GetPlanCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
