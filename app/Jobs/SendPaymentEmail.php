<?php

namespace App\Jobs;

use App\Mail\PaymentMail;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPaymentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Array $emailContent;
    protected Transaction $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $emailContent, Transaction $transaction)
    {
        $this->emailContent = $emailContent;
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
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
