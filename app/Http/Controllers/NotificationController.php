<?php

namespace App\Http\Controllers;

use App\Traits\GlobalHelper;
use App\Models\Notification;
use App\Models\Rank;
use App\Http\Requests\NotificationRequest;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    use GlobalHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ovde treba paginacija
        $notifications = Notification::get();
        //ubaci poruke negde
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
        return view('admin.pages.notifications.create')->with([
            'ranks' => $this->getRanks()->toArray(),
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
        return view('admin.pages.notifications.show')->with([
            'notification' => $notification,
            'ranks' => $this->getRanks(),
            'selectedRanks' => $this->getSelectedRanks($notification)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        return view('admin.pages.notifications.edit')->with([
            'notification' => $notification,
            'ranks' => $this->getRanks(),
            'selectedRanks' => $this->getSelectedRanks($notification)
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
        $notification->ranks()->sync($request->rank_id, false);

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
