<?php

namespace App\Application\CommandHandlers\Payment;

use App\Application\Commands\Payment\PayOldOrderCommand;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Domain\Repositories\IPlanRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Exception;

class PayOldOrderHandler
{
    public function __construct(
        private PaymentResolver $paymentResolver,
        private IPlanRepository $planRepository,
        private IOrderRepository $orderRepository
    ) {
    }

    public function handle(PayOldOrderCommand $command)
    {
        try {
            $dto = $command->dto;
            $plan = $this->planRepository->get($dto->plan_id);
            $dto->amount = $plan->price;

            $order = $this->handleExistOrder($dto->order_id);
            $lock = cache()->lock($order->id . ':payment:send', 120);
            if (!$lock->get()) {
                return throw new Exception(__('Có vấn đề trong yêu cầu thanh toán. Hãy cố gắng lại lần nữa sau ít phút.'));
            }
            $dto->lock_owner = $lock->owner();

            $paymentService = $this->paymentResolver->resolveService($dto->payment_name);
            $response = $paymentService->handlePayment($dto);

            return redirect($response['redirect']);
        } catch(Exception $e) {
            dd($e);
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function isCanPay(string $orderId) {
        $query =  $this->orderRepository->makeQuery()
            ->where('user_id', auth()->user()->id)
            ->where('id', '<>', $orderId)
            ->where('status', OrderStatus::PROCESSING)
            ->count();

        return $query < 1;
    }

    public function handleExistOrder(string $orderId) {
        $order = $this->orderRepository->get($orderId);

        if (!$this->isCanPay($order->id)) {
            throw new Exception(__('Bạn đã có một đơn hàng đang được xử lý. Vui lòng chờ đợi.'));
        }

        if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
            throw new Exception(__('Đơn hàng đã được xử lý hoặc đã bị hủy.'));
        }

        return $order;
    }
}
