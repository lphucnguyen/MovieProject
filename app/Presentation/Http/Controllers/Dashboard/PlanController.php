<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Plan\CreatePlanCommand;
use App\Application\Commands\Plan\DeletePlanCommand;
use App\Application\Commands\Plan\GetPlanCommand;
use App\Application\Commands\Plan\GetPlansWithPaginateCommand;
use App\Application\Commands\Plan\UpdatePlanCommand;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Plan\CreatePlanRequest;
use App\Presentation\Http\Requests\Plan\UpdatePlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_plans,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_plans,guard:admin'])->only('index');
        $this->middleware(['permission:update_plans,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_plans,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getPlansCommand = new GetPlansWithPaginateCommand();
        $plans = Bus::dispatch($getPlansCommand);

        return view('dashboard.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('dashboard.plans.create');
    }

    public function store(CreatePlanRequest $request)
    {
        $createPlanCommand = new CreatePlanCommand($request->slug, $request->amount);
        Bus::dispatch($createPlanCommand);

        return redirect()->route('dashboard.plans.index')->withSuccess(__('Plan thêm thành công'));
    }

    public function edit(string $uuid)
    {
        $getPlanCommand = new GetPlanCommand($uuid);
        $plan = Bus::dispatch($getPlanCommand);

        return view('dashboard.plans.edit', compact('plan'));
    }

    public function update(string $uuid, UpdatePlanRequest $request)
    {
        $updateMovieCommand = new UpdatePlanCommand($uuid, $request->slug, $request->price);
        Bus::dispatch($updateMovieCommand);

        return redirect()->back()->withSuccess(__('Plan cập nhật thành công'));
    }

    public function destroy(string $uuid)
    {
        $deleteMovieCommand = new DeletePlanCommand($uuid);
        Bus::dispatch($deleteMovieCommand);

        return redirect()->route('dashboard.plans.index')->withSuccess(__('Plan xoá thành công'));
    }
}
