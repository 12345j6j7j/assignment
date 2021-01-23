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
}