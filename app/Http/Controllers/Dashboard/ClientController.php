<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $clients = User::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'email' => 'required|string|email',
            'username' => 'required|unique:users|string|max:15|min:3',
            'avatar' => 'image',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($request->avatar) {
            $attributes['avatar'] = $request->avatar->store('client_avatars');
        }

        $result = User::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'avatar' => $attributes['avatar'] ?? NULL,
            'password' => bcrypt($attributes['password']),
            'expired_at' => Carbon::now()->toDateString()
        ]);

        session()->flash('success', 'Khách hàng thêm thành công');
        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $client
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        //
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $client)
    {
        //
        $attributes = $request->validate([
            'username' => 'required|string|max:20|min:3',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($client)],
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'avatar' => 'image',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        if ($request->avatar) {
            $clientAvatar = $client->getAttributes()['avatar'];
            if (isset($clientAvatar) && $clientAvatar) {
                Storage::delete($clientAvatar);
            }

            $attributes['avatar'] = $request->avatar->store('client_avatars');
        }
        if ($request->password) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $client->update($attributes);

        session()->flash('success', 'Khách hàng cập nhật thành công');
        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $client
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $client)
    {
        //
        $client->delete();

        session()->flash('success', 'Khách hàng xoá thành công');
        return redirect()->route('dashboard.clients.index');
    }
}
