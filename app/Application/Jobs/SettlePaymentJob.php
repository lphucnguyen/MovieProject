<?php

namespace App\Application\Jobs;

use App\Domain\Repositories\IOrderRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SettlePaymentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public int $delay = 10;

    public function __construct(
        private array $ordersSettle
    ) {
    }

    public function handle(
        PaymentResolver $paymentResolver,
        IOrderRepository $orderRepository,
    ) {
        foreach ($this->ordersSettle as $order) {
            try {
                $paymentService = $paymentResolver->resolveService($order->payment_name);
                $paymentService->captureAuthorization($order->transaction_id);

                $orderRepository->update($order->id, [
                    'paid_at' => now()
                ]);
            } catch (\Exception $e) {
                // Notification to Slack
                Log::error("Settlement failed for Order ID: {$order->id}. Error: " . $e->getMessage());
            }
        }
    }
}
