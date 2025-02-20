<?php

namespace App\Application\Console\Commands;

use App\Application\DTOs\Order\OrderSettleDTO;
use App\Application\Jobs\SettlePaymentJob;
use App\Domain\Repositories\IOrderRepository;
use Illuminate\Console\Command;

class SettlePaymentCommand extends Command
{
    protected $signature = 'orders:settle-payment';
    protected $description = 'Batch settle authorized orders for PayPal and Stripe';

    private $batchSize = 50;

    public function handle(
        IOrderRepository $orderRepository,
    ) {
        do {
            $orders = collect($orderRepository->getUnpaidOrder($this->batchSize));
            $orderSettle = $orders->map(function ($order) {
                return OrderSettleDTO::fromModel($order);
            })->toArray();

            SettlePaymentJob::dispatch($orderSettle);
        } while ($orders->count() === $this->batchSize);

        $this->info('Batch settlement process completed.');
    }
}