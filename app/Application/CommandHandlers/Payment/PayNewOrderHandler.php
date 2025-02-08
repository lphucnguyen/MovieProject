<?php

namespace App\Application\CommandHandlers\Payment;

use App\Application\Commands\Payment\PayNewOrderCommand;
use App\Application\Events\OrderCreated;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Domain\Repositories\IPlanRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Exception;

class PayNewOrderHandler
{
    public function __construct(
        private PaymentResolver $paymentResolver,
        private IPlanRepository $planRepository,
        private IOrderRepository $orderRepository
    ) {
    }

    public function handle(PayNewOrderCommand $command)
    {
        try {
            $dto = $command->dto;
            $plan = $this->planRepository->get($dto->plan_id);
            $dto->amount = $plan->price;

            $order = $this->handleNewOrder($dto->plan_id, $dto->payment_name, $dto->amount);
            $lock = cache()->lock($order->id . ':payment:send', 120);
            $dto->lock_owner = $lock->owner();
            $dto->order_id = $order->id;
            $paymentService = $this->paymentResolver->resolveService($dto->payment_name);
            $response = $paymentService->handlePayment($dto);

            event(new OrderCreated($response['paymentId'], $order->id));

            return redirect($response['redirect']);
        } catch(Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function isCanPay() {
        $query =  $this->orderRepository->makeQuery()
            ->where('user_id', auth()->user()->id)
            ->where('status', OrderStatus::PROCESSING)
            ->count();

        return $query < 1;
    }

    public function handleNewOrder($planId, $paymentName, $amount) {
        if (!$this->isCanPay()) {
            throw new Exception(__('Bạn đã có một đơn hàng đang được xử lý. Vui lòng chờ đợi.'));
        }

        return $this->orderRepository->create([
            'user_id' => auth()->user()->id,
            'plan_id' => $planId,
            'payment_name' => $paymentName,
            'currency' => config('services.currency'),
            'amount' => $amount,
            'status' => OrderStatus::PROCESSING
        ]);
    }
}
