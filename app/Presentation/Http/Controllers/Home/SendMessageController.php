<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Application\Commands\Home\SendMessageCommand;
use App\Application\DTOs\Home\SendMessageDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Home\SendMessageRequest;
use Illuminate\Support\Facades\Bus;

class SendMessageController extends Controller
{
    public function __invoke(SendMessageRequest $request)
    {
        $sendMessageCommand = new SendMessageCommand(
            SendMessageDTO::fromRequest($request)
        );
        Bus::dispatch($sendMessageCommand);

        return redirect()->back()->withSuccess(__('Cám ơn bạn đã liên hệ'));
    }
}