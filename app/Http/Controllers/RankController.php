<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Http\Requests\RankRequest;
use Illuminate\Support\Facades\Redirect;
use App\Traits\GlobalHelper;

class RankController extends Controller
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

        return view('admin.pages.ranks.index', compact('systemMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.ranks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RankRequest $request)
    {
        $validated = $request->validated();
        Rank::create($validated);

        return Redirect::route('ranks.index')->with('systemMessage', $this->created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {
        return view('admin.pages.ranks.show', compact('rank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $rank)
    {
        return view('admin.pages.ranks.edit', compact('rank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(RankRequest $request, Rank $rank)
    {
        $validated = $request->validated();
        $rank->update($validated);

        return Redirect::route('ranks.index')->with('systemMessage', $this->updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank)
    {
        $rank->delete();
        // return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully deleted!');
        return response()->json([
            'success' => true
        ], 200);
    }
}
