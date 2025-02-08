<?php

namespace App\Application\Listeners\Order;

use App\Application\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;

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
        private PaymentResolver $paymentResolver
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
            $payment = $this->paymentResolver->resolveService($order->payment_name);
            $payment->cancelPayment($event->paymentIntentId);
            $this->orderRepository->update($order->id, [
                'status' => OrderStatus::CANCELED->value
            ]);

            return;
        }

        $this->release($this->delay);
    }
}
