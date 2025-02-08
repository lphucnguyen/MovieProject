<?php

namespace App\Application\Listeners\User;

use App\Domain\Events\User\UserCreated;
use App\Domain\Repositories\IUserRepositoryNeo;

class CreateUser
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private IUserRepositoryNeo $filmRepository,
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $this->filmRepository->create([
            'id' => $event->userId,
            'email' => $event->email,
            'username' => $event->username,
            'first_name' => $event->firstName,
            'last_name' => $event->lastName
        ]);
    }
}
