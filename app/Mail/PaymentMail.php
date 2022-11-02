<?php

namespace App\Mail;

use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Transaction $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, String $title)
    {
        $this->transaction = $transaction;
        $this->subject($title);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transaction = $this->transaction;
        return $this->view('emails.transactions', compact('transaction'));
    }
}
