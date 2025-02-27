<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Application\Commands\Payment\ApprovalCommand;
use App\Application\DTOs\Payment\ApprovalPaymentStripeDTO;
use App\Application\DTOs\Payment\ApprovalPaymentPaypalDTO;
use App\Application\Enums\Payment\PaymentName;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Payment\ApprovalRequest;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Crypt;

class ApprovalController extends Controller
{
    public function __invoke(ApprovalRequest $request)
    {
        $request->validated();

        $decrypted_data = json_decode(Crypt::decryptString($request->encrypt_data), true);
        $decrypted_data = [
            ...$decrypted_data,
            'token' => $request->token,
        ];

        if ($decrypted_data['payment_name'] === PaymentName::PAYPAL->value) {
            $dto = new ApprovalPaymentPaypalDTO($decrypted_data);
        } else if ($decrypted_data['payment_name'] === PaymentName::STRIPE->value) {
            $dto = new ApprovalPaymentStripeDTO($decrypted_data);
        }

        $approvalCommand = new ApprovalCommand($dto);
        return Bus::dispatch($approvalCommand);
    }
}