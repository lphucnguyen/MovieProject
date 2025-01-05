<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\User\CreateUserCommand;
use App\Application\Commands\User\DeleteUserCommand;
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
        $getUsersCommand = new GetUsersCommand($request->search, 10);
        $clients = Bus::dispatch($getUsersCommand);

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

        session()->flash('success', 'Khách hàng thêm thành công');
        return redirect()->route('dashboard.clients.index');
    }

    public function edit(User $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(string $uuid, UpdateUserRequest $request)
    {
        $updateUserDTO = UpdateUserDTO::fromRequest($request);
        $updateUserCommand = new UpdateUserCommand($uuid, $updateUserDTO);
        Bus::dispatch($updateUserCommand);

        session()->flash('success', 'Khách hàng cập nhật thành công');
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(string $uuid)
    {
        $deleteUserCommand = new DeleteUserCommand($uuid);
        Bus::dispatch($deleteUserCommand);

        session()->flash('success', 'Khách hàng xoá thành công');
        return redirect()->route('dashboard.clients.index');
    }
}
