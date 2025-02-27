<?php

namespace App\Application\Console\Commands;

use App\Application\Jobs\SettlePaymentJob;
use Illuminate\Console\Command;

class SettlePaymentCommand extends Command
{
    protected $signature = 'orders:settle-payment';
    protected $description = 'Batch settle authorized orders for PayPal and Stripe';

    private $batchSize = 50;

    public function handle() {
        SettlePaymentJob::dispatch($this->batchSize);
        $this->info('Batch settlement processing.');
    }
}