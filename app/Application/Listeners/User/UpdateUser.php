<?php

namespace App\Application\Listeners\User;

use App\Domain\Events\User\UserUpdated;
use App\Domain\Repositories\IUserRepositoryNeo;

class UpdateUser
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
    public function handle(UserUpdated $event): void
    {
        $this->filmRepository->update($event->userId, [
            'first_name' => $event->firstName,
            'last_name' => $event->lastName
        ]);
    }
}
