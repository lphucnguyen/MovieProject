<?php

namespace App\Application\Events;

use App\Shared\Application\Concerns\HasMetadata;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPaid
{
    use Dispatchable;
    use SerializesModels;
    use HasMetadata;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $orderId
    ) {
    }
}
