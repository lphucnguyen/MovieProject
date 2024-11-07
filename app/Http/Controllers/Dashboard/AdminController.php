<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use App\Commands\Admin\CreateAdminCommand;
use App\Commands\Admin\DeleteAdminCommand;
use App\Commands\Admin\GetAdminsCommand;
use App\Commands\Admin\UpdateAdminCommand;
use App\DTOs\Admin\CreateAdminDTO;
use App\DTOs\Admin\UpdateAdminDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_admins,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_admins,guard:admin'])->only('index');
        $this->middleware(['permission:update_admins,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_admins,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getAdminsCommand = new GetAdminsCommand($request->searchKey, 10);
        $admins = Bus::dispatch($getAdminsCommand);

        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $createAdminCommand = new CreateAdminCommand(
            CreateAdminDTO::fromRequest($request)
        );
        Bus::dispatch($createAdminCommand);

        session()->flash('success', 'Ban quản trị đã thêm thành công');
        return redirect()->route('dashboard.admins.index');
    }

    public function edit(Admin $admin)
    {
        if (!auth()->guard('admin')->user()->hasRole('super_admin') && $admin->hasRole('super_admin')) {
            abort('403');
        }
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(string $uuid, UpdateAdminRequest $request)
    {
        if (!auth()->guard('admin')->user()->hasRole('super_admin')) {
            abort('403');
        }

        $updateAdminCommand = new UpdateAdminCommand(
            $uuid,
            UpdateAdminDTO::fromRequest($request)
        );
        Bus::dispatch($updateAdminCommand);

        session()->flash('success', 'Ban quản trị cập nhật thành công');
        return redirect()->route('dashboard.admins.index');
    }

    public function destroy(string $uuid)
    {
        $deleteAdminCommand = new DeleteAdminCommand($uuid);
        Bus::dispatch($deleteAdminCommand);

        session()->flash('success', 'Ban quản trị xoá thành công');
        return redirect()->route('dashboard.admins.index');
    }
}
