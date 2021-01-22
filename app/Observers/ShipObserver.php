<?php

namespace App\Observers;

use App\Models\Ship;
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
    }

    /**
     * Handle the ship "updated" event.
     *
     * @param \App\Ship $ship
     * @throws \ReflectionException
     */
    public function updated(Ship $ship)
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

    /**
     * Handle the ship "restored" event.
     *
     * @param \App\Ship $ship
     * @return void
     */
    public function restored(Ship $ship)
    {
        //
    }

    /**
     * Handle the ship "force deleted" event.
     *
     * @param \App\Ship $ship
     * @return void
     */
    public function forceDeleted(Ship $ship)
    {
        //
    }
}
