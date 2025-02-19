<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Application\Commands\Payment\ApprovalCommand;
use App\Application\DTOs\Payment\ApprovalPaymentStripeDTO;
use App\Application\DTOs\Payment\ApprovalPaymentPaypalDTO;
use App\Application\Enums\Payment\PaymentName;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Payment\ApprovalRequest;
use Illuminate\Support\Facades\Bus;

class ApprovalController extends Controller
{
    public function __invoke(ApprovalRequest $request)
    {
        $request->validated();

        if ($request->payment_name === PaymentName::PAYPAL->value) {
            $dto = ApprovalPaymentPaypalDTO::fromRequest($request);
        } else if ($request->payment_name === PaymentName::STRIPE->value) {
            $dto = ApprovalPaymentStripeDTO::fromRequest($request);
        }

        $approvalCommand = new ApprovalCommand($dto);
        return Bus::dispatch($approvalCommand);
    }
}