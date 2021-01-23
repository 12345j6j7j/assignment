<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Rank;
use App\Http\Requests\NotificationRequest;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ovde treba paginacija
        $notifications = Notification::get();
        $systemMessage = session()->get('systemMessage');

        return view('admin.pages.notifications.index', compact('notifications','systemMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ranks = Rank::select('id', 'name')->get()->pluck('name', 'id');

        return view('admin.pages.notifications.create')->with([
            'ranks' => $ranks->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        $notification = Notification::create($request->all());
        $notification->ranks()->sync($request->rank_id, false);

        return Redirect::route('notifications.index')->with('systemMessage', 'Your record is successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return view('admin.pages.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        $ranks = Rank::select('id', 'name')->get()->pluck('name', 'id');

        $selectedRanks = [];

        foreach ($notification->ranks as $rank) {
            $selectedRanks[] = $rank->id;
        }
        
        return view('admin.pages.notifications.edit')->with([
            'notification' => $notification,
            'ranks' => $ranks,
            'selectedRanks' => $selectedRanks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        $notification->update($request->all());
        
        $notification->ranks()->detach();
        $notification->ranks()->attach($request->rank_id);

        return Redirect::route('notifications.index')->with('systemMessage', 'Your record is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        // return Redirect::route('ships.index')->with('systemMessage', 'Your record is successfully deleted!');
        return response()->json([
            'success' => true
        ], 200);
    }
}
