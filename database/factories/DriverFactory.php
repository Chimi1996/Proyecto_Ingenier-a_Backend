<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_driver' => $this->faker->unique()->userName,
            'phone_number' => \App\Models\User::factory()->create()->phone_number,
            'driver_current_location' => $this->faker->address,
        ];
    }
}
