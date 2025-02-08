<?php

namespace App\Application\Listeners\User;

use App\Domain\Events\User\UserDeleted;
use App\Domain\Repositories\IUserRepositoryNeo;

class DeleteUser
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
    public function handle(UserDeleted $event): void
    {
        $this->filmRepository->delete($event->userId);
    }
}
