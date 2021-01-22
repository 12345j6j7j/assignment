<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<11;$i++) {
            Ship::factory()->create([
                'name' => 'Ship number: ' . $i,
                'serial_number' => rand (10000000,99999999),
                'image' => 'this/is/path/of/image_' . $i,
            ]);    
        }
    }
}
