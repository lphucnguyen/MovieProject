<?php

use App\Domain\Enums\Order\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('amount');
            $table->string('currency');
            $table->string('payment_name');
            $table->enum('status', [
                OrderStatus::CANCELED->value,
                OrderStatus::PENDING->value,
                OrderStatus::COMPLETED->value,
                OrderStatus::PROCESSING->value
            ])->default(
                OrderStatus::PENDING->value
            );
            $table->timestamps();

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
