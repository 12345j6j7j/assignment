<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rank;
use App\Models\Ship;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $systemMessage = session()->get('systemMessage');

        return view('admin.pages.users.index', compact('users','systemMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);

        return Redirect::route('users.index')->with('systemMessage', 'Your record is successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $ships = Ship::select('id', 'name')->get()->pluck('name', 'id');
        $ranks = Rank::select('id', 'name')->get()->pluck('name', 'id');
        
        return view('admin.pages.users.edit')->with([
            'user' => $user,
            'ships' => $ships->toArray(),
            'ranks' => $ranks->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // dd($request->all());
        $validated = $request->validated();
        $user->update($validated);

        return Redirect::route('users.index')->with('systemMessage', 'Your record is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully deleted!');
        return response()->json([
            'success' => true
        ], 200);
    }
}
