<?php

namespace App\Domain\Events\User;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $userId,
        public string $username,
        public string $email,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
