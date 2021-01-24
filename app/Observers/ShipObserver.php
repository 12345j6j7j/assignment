<?php

namespace App\Observers;

use App\Models\Ship;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use File;

class ShipObserver
{
    /**
     * Handle the ship "created" event.
     *
     * @param \App\Ship $ship
     * @throws \ReflectionException
     */
    public function created(Ship $ship) 
    {
        DB::table($ship->getTable())->where('id', $ship->id)->update(['image' => $ship->storeImage()]);
        
        if(array_key_exists('user_ids', request()->all())) {
            $users = User::whereIn('id', request()->user_ids)->get();
            $ship->users()->saveMany($users);
        }
    }

    /**
     * Handle the ship "saving" event.
     *
     * @param \App\Ship $ship
     * @throws \ReflectionException
     */
    public function saving(Ship $ship)
    {
        DB::table($ship->getTable())->where('id', $ship->id)->update(['image' => $ship->storeImage()]);

        if(array_key_exists('user_ids', request()->all())) {
            $users = User::whereIn('id', request()->user_ids)->get();
            $ship->users()->update(['ship_id' => null]);
            $ship->users()->saveMany($users);
        }

        $ship->users()->update(['ship_id' => null]);
    }

    /**
     * Handle the ship "updating" event.
     *
     * @param \App\Ship $ship
     * @throws \ReflectionException
     */
    public function updating(Ship $ship)
    {
        DB::table($ship->getTable())->where('id', $ship->id)->update(['image' => $ship->storeImage()]);
    }

    /**
     * Handle the ship "deleted" event.
     *
     * @param \App\Ship $ship
     * @return void
     */
    public function deleted(Ship $ship)
    {
        if (!empty($ship->image)) File::delete($ship->image);
    }
}
