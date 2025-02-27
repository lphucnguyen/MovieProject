<?php

namespace App\Application\Commands\Plan;

class UpdatePlanCommand
{
    public function __construct(
        public string $uuid,
        public string $slug,
        public int $price,
    ) {
    }
}

