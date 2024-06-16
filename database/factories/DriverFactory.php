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
            'id_user' => \App\Models\User::factory(),
            'driver_current_location' => $this->faker->address,
        ];
    }
}
