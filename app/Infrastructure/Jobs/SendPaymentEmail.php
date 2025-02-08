<?php

namespace App\Infrastructure\Jobs;

use App\Domain\Models\Order;
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

    public function __construct(
        private array $emailContent,
        private Order $transaction
    ) {
    }

    public function handle()
    {
        $title = $this->emailContent['title'];
        $email = $this->emailContent['email'];
        $emailPayment = new PaymentMail(
            $this->transaction,
            $title
        );

        Mail::to($email)->send($emailPayment);
    }
}
