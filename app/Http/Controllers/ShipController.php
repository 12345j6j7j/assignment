<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Http\Requests\ShipRequest;
use App\Traits\GlobalHelper;
use Illuminate\Support\Facades\Redirect;

class ShipController extends Controller
{
    use GlobalHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemMessage = session()->get('systemMessage');

        return view('admin.pages.ships.index', compact('systemMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.ships.create')->with([
            'users' => $this->getUsers()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipRequest $request)
    {
        Ship::create($request->except('image'));

        return Redirect::route('ships.index')->with('systemMessage', $this->created);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        return view('admin.pages.ships.show')->with([
            'ship' => $ship,
            'users' => $ship->users()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        return view('admin.pages.ships.edit')->with([
            'ship' => $ship,
            'users' => $this->getUsers(),
            'currentCrew' => $this->getCurrentCrew($ship)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(ShipRequest $request, Ship $ship)
    {
        $ship->update($request->except('image'));

        return Redirect::route('ships.index')->with('systemMessage', $this->updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        $ship->delete();
        // return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully deleted!');
        return response()->json([
            'success' => true
        ], 200);
    }
}
