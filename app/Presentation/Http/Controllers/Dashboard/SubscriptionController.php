<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Subscription\DeleteSubscriptionCommand;
use App\Application\Commands\Subscription\GetSubscriptionCommand;
use App\Application\Commands\Subscription\GetSubscriptionsCommand;
use App\Application\Commands\Subscription\UpdateSubscriptionCommand;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Subscription\UpdateSubscriptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_subscriptions,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_subscriptions,guard:admin'])->only('index');
        $this->middleware(['permission:update_subscriptions,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_subscriptions,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getSubscriptionsCommand = new GetSubscriptionsCommand($request->searchKey);
        $subscriptions = Bus::dispatch($getSubscriptionsCommand);

        return view('dashboard.subscriptions.index', compact('subscriptions'));
    }

    public function edit(string $uuid)
    {
        $getSubscriptionCommand = new GetSubscriptionCommand($uuid);
        $subscription = Bus::dispatch($getSubscriptionCommand);

        return view('dashboard.subscriptions.edit', compact('subscription'));
    }

    public function update(string $uuid, UpdateSubscriptionRequest $request)
    {
        $updateSubscriptionCommand = new UpdateSubscriptionCommand($uuid, $request->active_until);
        Bus::dispatch($updateSubscriptionCommand);

        return redirect()->back()->withSuccess(__('Subscription cập nhật thành công'));
    }

    public function destroy(string $uuid)
    {
        $deleteSubscriptionCommand = new DeleteSubscriptionCommand($uuid);
        Bus::dispatch($deleteSubscriptionCommand);

        return redirect()->route('dashboard.subscriptions.index')->withSuccess(__('Subscription xoá thành công'));
    }
}
