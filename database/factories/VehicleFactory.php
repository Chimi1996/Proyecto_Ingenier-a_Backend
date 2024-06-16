<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'license_plate' => strtoupper($this->faker->unique()->bothify('???###')),
            'id_driver' => \App\Models\Driver::factory(),
        ];
    }
}
