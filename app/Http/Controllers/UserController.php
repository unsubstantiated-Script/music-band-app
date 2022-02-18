<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        switch ($request) {
            case $request->has('name'):
                //making the db Eloquent query case-insensitive
                $orderClause = 'UPPER(' . 'name' . ') ASC';
                $users = \App\Models\User::orderByRaw($orderClause)->paginate(10);
                //Making sure the order is retained through the pagination links
                $users->appends('name', 'asc')->links();
                break;
            case $request->has('role'):
                $orderClause = 'UPPER(' . 'role' . ') ASC';
                $users = \App\Models\User::orderByRaw($orderClause)->paginate(10);
                $users->appends('role', 'asc')->links();
                break;
            default:
                $users = \App\Models\User::paginate(10);
                break;
        }

        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', User::class)) {
            return redirect()->route('users.index')->with('error', 'You do not have permission');
        }

        $user = new \App\Models\User();
        return view('users.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        \App\Models\User::create($this->validateDataHashPassword($request));
        return redirect()->route('users.index')->with('success', 'User was added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->user()->cannot('view', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        $user = \App\Models\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->user()->cannot('update', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->cannot('update', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        \App\Models\User::find($id)->update($this->validateDataHashPassword($request));
        return redirect()->route('users.index')->with('success', 'User was updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->user()->cannot('delete', User::class)) {
            return redirect()->route('musicians.index')->with('error', 'You do not have permission');
        }

        $user = \App\Models\User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User was successfully deleted');

    }

    private function validateDataHashPassword($request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required',
            ]
        );

        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
    }
}
