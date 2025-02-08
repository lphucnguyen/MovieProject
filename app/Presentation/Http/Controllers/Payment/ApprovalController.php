<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Application\Commands\Payment\ApprovalCommand;
use App\Application\DTOs\Payment\ApprovalPaymentDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Payment\ApprovalRequest;
use Illuminate\Support\Facades\Bus;

class ApprovalController extends Controller
{
    public function __invoke(ApprovalRequest $request)
    {
        $request->validated();

        $approvalCommand = new ApprovalCommand(ApprovalPaymentDTO::fromRequest($request));
        return Bus::dispatch($approvalCommand);
    }
}