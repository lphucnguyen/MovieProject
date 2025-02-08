<?php

namespace App\Application\Listeners\Order;

use App\Application\Events\OrderPaid;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RefundOrder implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public int $tries = 3;

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
    public function handle(OrderPaid $event): void
    {
        try{
            $order = $this->orderRepository->get($event->orderId);

            if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
                $paymentService = $this->paymentResolver->resolveService($order->payment_name);
                $paymentService->refundPayment($event->paymentId);
            }

            Log::info('Refund order success with order id: ' . $event->orderId);
        } catch(Exception $e) {
            Log::error($e->getMessage());

            throw $e;
        }
    }
}
