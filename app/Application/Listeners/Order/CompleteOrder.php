<?php

namespace App\Application\Listeners\Order;

use App\Application\Events\OrderPaid;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Domain\Repositories\IPlanRepository;
use App\Domain\Repositories\ISubscriptionRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Exception;
use Illuminate\Support\Facades\DB;

class CompleteOrder
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private IOrderRepository $orderRepository,
        private ISubscriptionRepository $subscriptionRepository,
        private IPlanRepository $planRepository,
        private PaymentResolver $paymentResolver
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaid $event): void
    {
        try{
            DB::beginTransaction();
            $lock = cache()->restoreLock($event->orderId . ':payment:send', $event->lockOwner);
            $order = $this->orderRepository->getToUpdate($event->orderId);

            if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
                return;
            }

            $this->orderRepository->update($event->orderId, [
                'status' => OrderStatus::COMPLETED
            ]);

            $plan = $this->planRepository->get($event->planId);

            $this->subscriptionRepository->create([
                'user_id' => auth()->user()->id,
                'plan_id' => $event->planId,
                'active_until' => now()->addDays($plan->duration_in_days),
            ]);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        } finally {
            $lock->release();
        }
    }
}
