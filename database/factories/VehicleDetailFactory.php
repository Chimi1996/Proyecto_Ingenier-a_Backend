<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_detail' => $this->faker->unique()->userName,
            'license_plate' => \App\Models\Vehicle::factory(),
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'year' => $this->faker->year,
            'color' => $this->faker->safeColorName,
        ];
    }
}
