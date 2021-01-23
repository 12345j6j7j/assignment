<?php

namespace App\Traits;

use App\Models\Rank;

trait GlobalHelper
{
    public function getRanks()
    {
        return Rank::select('id', 'name')->get()->pluck('name', 'id');
    }

    public function getSelectedRanks($notification)
    {
        $selectedRanks = [];

        foreach ($notification->ranks as $rank) {
            $selectedRanks[] = $rank->id;
        }

        return $selectedRanks;
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