<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripsTableSeeder extends Seeder
{
    public function run()
    {
        Trip::factory()->count(10)->create();
    }
}
