<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<11;$i++) {
            Rank::factory()->create([
                'name' => 'Rank: ' . $i,
            ]);  
        }   
    }
}
