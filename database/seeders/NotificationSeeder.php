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
        for($i=1;$i<11;$i++) {
            Notification::factory()->create([
                'content' => 'This is the content of notification: ' . $i
            ]);    
        }
    }
}
