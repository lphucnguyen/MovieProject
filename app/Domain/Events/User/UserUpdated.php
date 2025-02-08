<?php

namespace App\Domain\Events\User;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $userId,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
