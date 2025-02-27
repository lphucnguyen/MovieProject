<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Subscription\GetSubscriptionByUserIdCommand;
use App\Application\Commands\User\CreateUserCommand;
use App\Application\Commands\User\DeleteUserCommand;
use App\Application\Commands\User\GetUserCommand;
use App\Application\Commands\User\GetUsersCommand;
use App\Application\Commands\User\UpdateUserCommand;
use App\Application\DTOs\User\CreateUserDTO;
use App\Application\DTOs\User\UpdateUserDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Dashboard\CreateUserRequest;
use App\Presentation\Http\Requests\Dashboard\UpdateUserRequest;
use App\Domain\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_clients,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_clients,guard:admin'])->only('index');
        $this->middleware(['permission:update_clients,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_clients,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $clients = Bus::dispatch(new GetUsersCommand($request->searchKey));

        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(CreateUserRequest $request)
    {
        $createUserCommand = new CreateUserCommand(
            CreateUserDTO::fromRequest($request)
        );
        Bus::dispatch($createUserCommand);

        return redirect()->route('dashboard.clients.index')->withSuccess(__('Khách hàng thêm thành công'));
    }

    public function edit(string $uuid)
    {
        $client = Bus::dispatch(new GetUserCommand($uuid));
        $subscription = Bus::dispatch(new GetSubscriptionByUserIdCommand($uuid));

        return view('dashboard.clients.edit', compact('client', 'subscription'));
    }

    public function update(string $uuid, UpdateUserRequest $request)
    {
        $updateUserDTO = UpdateUserDTO::fromRequest($request);
        $updateUserCommand = new UpdateUserCommand($uuid, $updateUserDTO);
        Bus::dispatch($updateUserCommand);

        return redirect()->route('dashboard.clients.index')->withSuccess(__('Khách hàng cập nhật thành công'));
    }

    public function destroy(string $uuid)
    {
        $deleteUserCommand = new DeleteUserCommand($uuid);
        Bus::dispatch($deleteUserCommand);

        return redirect()->route('dashboard.clients.index')->withSuccess(__('Khách hàng xoá thành công'));
    }
}
