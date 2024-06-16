<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehiclesTableSeeder extends Seeder
{
    public function run()
    {
        Vehicle::factory()->count(10)->create();
    }
}
