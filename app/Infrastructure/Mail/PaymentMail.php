<?php

namespace App\Infrastructure\Mail;

use App\Domain\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $title)
    {
        $this->order = $order;
        $this->subject($title);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        return $this->view('emails.order', compact('order'));
    }
}
