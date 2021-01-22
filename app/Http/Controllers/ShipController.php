<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Http\Requests\ShipRequest;
use Illuminate\Support\Facades\Redirect;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ships = Ship::get();
        $systemMessage = session()->get('systemMessage');

        return view('admin.pages.ships.index', compact('ships','systemMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.ships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipRequest $request)
    {
        $validated = $request->validated();
        Ship::create($validated);

        return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully added!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        return view('admin.pages.ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        return view('admin.pages.ships.edit', compact('ship'));
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
        $validated = $request->validated();
        $ship->update($validated);

        return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully updated!');
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
