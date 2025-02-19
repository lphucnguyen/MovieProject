<?php

namespace App\Application\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPaid
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $email,
        public string $orderId
    ) {
    }
}
