<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Commands\Actor\CreateActorCommand;
use App\Commands\Actor\DeleteActorCommand;
use App\Commands\Actor\GetActorsCommand;
use App\Commands\Actor\UpdateActorCommand;
use App\DTOs\Actor\CreateActorDTO;
use App\DTOs\Actor\UpdateActorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateActorRequest;
use App\Http\Requests\Dashboard\UpdateActorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;

class ActorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_actors,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_actors,guard:admin'])->only('index');
        $this->middleware(['permission:update_actors,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_actors,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getActorsCommand = new GetActorsCommand($request->searchKey, $request->film);
        $actors = Bus::dispatch($getActorsCommand);

        return view('dashboard.actors.index', compact('actors'));
    }

    public function create()
    {
        return view('dashboard.actors.create');
    }

    public function store(CreateActorRequest $request)
    {
        $createActorDTO = CreateActorDTO::fromRequest($request);
        Bus::dispatch(new CreateActorCommand($createActorDTO));

        session()->flash('success', 'Diễn viên đã thêm thành công');
        return redirect()->route('dashboard.actors.index');
    }

    public function edit(Actor $actor)
    {
        return view('dashboard.actors.edit', compact('actor'));
    }

    public function update(string $uuid, UpdateActorRequest $request)
    {
        $updateActorDTO = UpdateActorDTO::fromRequest($request);
        Bus::dispatch(new UpdateActorCommand($uuid, $updateActorDTO));

        session()->flash('success', 'Diễn viên cập nhật thành công');
        return redirect()->route('dashboard.actors.index');
    }

    public function destroy(Request $actor)
    {
        $deleteActorCommand = new DeleteActorCommand($actor->uuid);
        Bus::dispatch($deleteActorCommand);

        session()->flash('success', 'Diễn viên đã xoá thành công');
        return redirect()->route('dashboard.actors.index');
    }
}
