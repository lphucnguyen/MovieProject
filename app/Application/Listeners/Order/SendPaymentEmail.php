<?php

namespace App\Application\Listeners\Order;

use App\Application\DTOs\Order\OrderEmailDTO;
use App\Application\Events\OrderPaid;
use App\Domain\Repositories\IOrderRepository;
use App\Domain\Repositories\IUserRepository;
use App\Infrastructure\Mail\PaymentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPaymentEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $title = 'Hoá đơn thanh toán';

    public function __construct(
        private IOrderRepository $orderRepository,
        private IUserRepository $userRepository
    ) {
    }

    public function handle(OrderPaid $event)
    {
        $order = $this->orderRepository->get($event->orderId);
        $user = $this->userRepository->get($order->user_id);
        $metadata = $event->metadata;

        $transaction = new OrderEmailDTO([
            'id' => $order->id,
            'created_at' => $order->created_at,
            'payment_name' => $order->payment_name,
            'amount' => $order->amount,
            'currency' => $order->currency,
            'user_first_name' => $user->first_name,
            'user_last_name' => $user->last_name
        ]);

        $emailPayment = new PaymentMail(
            $transaction,
            $this->title
        );

        Mail::to($metadata['email'])->send($emailPayment);
    }
}
