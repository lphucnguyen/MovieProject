<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\CancelOrderCommand;
use App\Domain\Enums\Order\OrderStatus;
use App\Domain\Repositories\IOrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelOrderHandler
{
    public function __construct(
        private IOrderRepository $repository
    ) {
    }

    public function handle(CancelOrderCommand $command)
    {
        try {
            DB::beginTransaction();

            $order = $this->repository->getWithLock($command->uuid);
            if ($order->status === OrderStatus::CANCELED->value || $order->status === OrderStatus::COMPLETED->value) {
                return redirect()->back()->with('error', __('Đơn hàng đã hoàn thành hoặc huỷ'));
            }

            $lock = cache()->lock(auth()->user()->id . ':payment:send', 120);
            if (!$lock->get()) {
                return redirect()
                    ->back()
                    ->with('error', __('Hiện tại đăng có một yêu cầu thanh toán. Hãy cố gắng lại lần nữa sau ít phút.'));
            }

            $this->repository->update($command->uuid, [
                'status' => OrderStatus::CANCELED->value
            ]);

            return redirect()->back()->withSuccess(__('Đơn hàng huỷ thành công'));

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()
                ->back()
                ->with('error', __("Không thể huỷ đơn hàng"));
        }
    }
}
