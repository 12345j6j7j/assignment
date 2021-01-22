<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::factory()->create([
            'rank_id' => 1,
            'name' => 'Notification 1',
            'content' => 'This is the content of notification: 1'
        ]);    
        
        Notification::factory()->create([
            'rank_id' => 2,
            'name' => 'Notification: 2',
            'content' => 'This is the content of notification: 2'
        ]);    
    }
}
