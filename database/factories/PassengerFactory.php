<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_passenger' => $this->faker->unique()->userName,
            'id_user' => \App\Models\User::factory(),
            'passenger_current_location' => $this->faker->address,
        ];
    }
}
