<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\CancelOrderCommand;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;

class CancelOrderHandler
{
    public function __construct(
        private IOrderRepository $repository
    ) {
    }

    public function handle(CancelOrderCommand $command)
    {
        $order = $this->repository->get($command->uuid);
        if ($order->status !== OrderStatus::PROCESSING->value) {
            return redirect()->back()->with('error', __('Đơn hàng đã hoàn thành hoặc huỷ'));
        }

        $lock = cache()->lock($command->uuid . ':payment:send', 120);
        if (!$lock->get()) {
            return redirect()
                ->back()
                ->with('error', __('Có vấn đề trong yêu cầu thanh toán. Hãy cố gắng lại lần nữa sau ít phút.'));
        }

        $this->repository->update($command->uuid, [
            'status' => OrderStatus::CANCELED->value
        ]);

        return redirect()->back()->withSuccess(__('Đơn hàng huỷ thành công'));
    }
}
