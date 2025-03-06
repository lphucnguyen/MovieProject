<?php

namespace App\Infrastructure\Mail;

use App\Application\DTOs\Order\OrderEmailDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private OrderEmailDTO $order,
        string $title
    ) {
        $this->subject($title);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order', [
            'order' => $this->order,
            'user' => auth()->user()
        ]);
    }
}
