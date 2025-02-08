<?php

namespace App\Application\CommandHandlers\Payment;

use App\Application\Commands\Payment\ApprovalCommand;
use App\Application\Events\OrderPaid;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;

class ApprovalHandler
{
    public function __construct(
        private PaymentResolver $paymentResolver,
        private IOrderRepository $orderRepository
    ) {
    }

    public function handle(ApprovalCommand $command)
    {
        try {
            $approvalDTO = $command->dto;
            $paymentName = $approvalDTO->payment_name;
            $paymentPlatform = $this->paymentResolver->resolveService($paymentName);
            $paymentId =  $paymentPlatform->handleApproval($approvalDTO);

            if ($paymentId instanceof \Illuminate\View\View) {
                return $paymentId;
            }

            $order = $this->orderRepository->get($approvalDTO->order_id);

            event(
                new OrderPaid(
                    $approvalDTO->order_id,
                    $approvalDTO->plan_id,
                    $approvalDTO->lock_owner,
                    $paymentId
                )
            );

            if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
                return redirect()
                    ->route('user.upgrade-account')
                    ->with('error', 'Thanh toán không thành công.');
            }

            return redirect()
                ->route('user.upgrade-account')
                ->withSuccess("Nâng cấp thành công. Chúc bạn có những phút giây thú vị tại trang web của chúng tôi");
        } catch(\Exception $e) {
            return redirect()
                ->route('user.upgrade-account')
                ->with('error', 'Chúng tôi không thể xác nhận thanh toán của bạn. Vui lòng thử lại sau ít phút');
        }
    }
}