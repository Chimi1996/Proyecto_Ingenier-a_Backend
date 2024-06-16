<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleDetail;

class VehicleDetailsTableSeeder extends Seeder
{
    public function run()
    {
        VehicleDetail::factory()->count(10)->create();
    }
}
