<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Message\DeleteMessageCommand;
use App\Application\Commands\Message\GetMessagesCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $getMessagesCommand = new GetMessagesCommand($request->searchKey);
        $messages = Bus::dispatch($getMessagesCommand);

        return view('dashboard.messages.index', compact('messages'));
    }

    public function destroy(string $uuid)
    {
        $deleteMessageCommand = new DeleteMessageCommand($uuid);
        Bus::dispatch($deleteMessageCommand);

        return redirect()->route('dashboard.messages.index')->withSuccess(__('Tin nhắn xoá thành công'));
    }
}
