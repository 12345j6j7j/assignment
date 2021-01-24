<?php

namespace App\Traits;

use App\Models\Rank;
use App\Models\Ship;
use App\Models\User;

trait GlobalHelper
{
    public $created = ['created' => 'Your record is successfully created!'];
    public $updated = ['updated' =>'Your record is successfully updated!'];
    public $deleted = ['deleted' =>'Your record is successfully deleted!'];

    public function getRanks()
    {
        return Rank::select('id', 'name')->get()->pluck('name', 'id');
    }

    public function getShips()
    {
        return Ship::select('id', 'name')->get()->pluck('name', 'id');
    }

    public function getUsers()
    {
        return User::select('id', 'name')->get()->pluck('name', 'id');
    }

    public function getSelectedRanks($notification)
    {
        $selectedRanks = [];

        foreach ($notification->ranks as $rank) {
            $selectedRanks[] = $rank->id;
        }

        return $selectedRanks;
    }
    
    public function getCurrentCrew($ship)
    {
        $currentCrew = [];

        foreach ($ship->users as $user) {
            $currentCrew[] = $user->id;
        }

        return $currentCrew;
    }

    public function sendNotifications($notification)
    {
        $ranks = $notification->ranks()->with('users')->has('users')->get();

        $userIds = [];

        foreach($ranks as $rank){
            foreach($rank->users as $user) {
                $userIds[] = $user->id;
            }
        }
        
        return $deliver = $notification->users()->attach($userIds);
    }
}