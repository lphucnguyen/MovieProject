<?php

namespace App\Application\CommandHandlers\Payment;

use App\Application\Commands\Payment\ApprovalCommand;
use App\Application\Events\OrderPaid;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use App\Domain\Repositories\IPlanRepository;
use App\Domain\Repositories\ISubscriptionRepository;
use App\Infrastructure\Services\Payment\PaymentResolver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApprovalHandler
{
    public function __construct(
        private PaymentResolver $paymentResolver,
        private IOrderRepository $orderRepository,
        private ISubscriptionRepository $subscriptionRepository,
        private IPlanRepository $planRepository
    ) {
    }

    public function handle(ApprovalCommand $command)
    {
        try {
            DB::beginTransaction();

            $approvalDTO = $command->dto;
            $paymentName = $approvalDTO->payment_name;
            $paymentPlatform = $this->paymentResolver->resolveService($paymentName);
            $paymentId = $paymentPlatform->handleApproval($approvalDTO);

            $order = $this->orderRepository->getWithLock($approvalDTO->order_id);

            if ($order->status === OrderStatus::COMPLETED->value || $order->status === OrderStatus::CANCELED->value) {
                $paymentPlatform->declineAuthorization($paymentId);

                return redirect()
                    ->route('user.upgrade-account')
                    ->with('error', 'Thanh toán không thành công.');
            }

            $this->orderRepository->update($approvalDTO->order_id, [
                'status' => OrderStatus::COMPLETED,
                'transaction_id' => $paymentId,
                'payment_name' => $paymentName
            ]);

            $plan = $this->planRepository->get($approvalDTO->plan_id);

            $this->subscriptionRepository->create([
                'user_id' => auth()->user()->id,
                'plan_id' => $approvalDTO->plan_id,
                'active_until' => now()->addDays($plan->duration_in_days),
            ]);

            $event = new OrderPaid($order->id);
            $event->metadata['email'] = auth()->user()->email;
            event($event);

            DB::commit();

            return redirect()
                ->route('user.upgrade-account')
                ->withSuccess("Nâng cấp thành công. Chúc bạn có những phút giây thú vị tại trang web của chúng tôi");
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()
                ->route('user.upgrade-account')
                ->with('error', 'Chúng tôi không thể xác nhận thanh toán của bạn. Vui lòng thử lại sau ít phút');
        }
    }
}