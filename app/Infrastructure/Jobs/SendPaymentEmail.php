<?php

namespace App\Infrastructure\Jobs;

use App\Application\DTOs\Order\OrderEmailDTO;
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
        private string $email,
        private OrderEmailDTO $transaction
    ) {
    }

    public function handle()
    {
        $emailPayment = new PaymentMail(
            $this->transaction,
            $this->title
        );

        Mail::to($this->email)->send($emailPayment);
    }
}
