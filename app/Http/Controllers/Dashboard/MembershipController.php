<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Membership;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_memberships,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_memberships,guard:admin'])->only('index');
        $this->middleware(['permission:update_memberships,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_memberships,guard:admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $memberships = Membership::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('title', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.memberships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'price' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'time_expired' => ['required', 'integer'],
            'title' => ['required','string', 'unique:memberships']
        ]);

        $membership = Membership::create([
            'price' => $attributes['price'],
            'description' => $attributes['description'],
            'time_expired' => $attributes['time_expired'],
            'title' => $attributes['title']
        ]);

        session()->flash('success', 'Membership đã thêm thành công');
        return redirect()->route('dashboard.memberships.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
        return view('dashboard.memberships.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        $attributes = $request->validate([
            'price' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'time_expired' => ['required', 'integer'],
            'title' => ['required', 'string', Rule::unique('memberships')->ignore($membership)]
        ]);

        $membership->update($attributes);

        session()->flash('success', 'Membership đã được cập nhật thành công');
        return redirect()->route('dashboard.memberships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();

        session()->flash('success', 'Đã xoá membership');
        return redirect()->route('dashboard.memberships.index');
    }
}
