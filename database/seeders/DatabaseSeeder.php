<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        RoleAndPermissionSeeder::class,
        RankSeeder::class,
        ShipSeeder::class,
        NotificationSeeder::class,
    ];
        
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
