<?php

namespace App\Http\Controllers\Dashboard;

use App\Commands\Message\DeleteMessageCommand;
use App\Commands\Message\GetMessagesCommand;
use App\Http\Controllers\Controller;
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

        session()->flash('success', 'Tin nhắn xoá thành công');
        return redirect()->route('dashboard.messages.index');
    }
}
