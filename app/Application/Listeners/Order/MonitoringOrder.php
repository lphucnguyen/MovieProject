<?php

namespace App\Application\Listeners\Order;

use App\Application\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;

class MonitoringOrder implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public int $tries = 4;
    public int $delay = 900;

    /**
     * Create the event listener.
     */
    public function __construct(
        private IOrderRepository $orderRepository,
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event):void {
        $order = $this->orderRepository->get($event->orderId);

        if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
            return;
        }

        if ($order->olderThan(59)) {
            $this->orderRepository->update($order->id, [
                'status' => OrderStatus::CANCELED->value
            ]);

            return;
        }

        $this->release($this->delay);
    }
}
