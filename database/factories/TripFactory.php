<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_trip' => $this->faker->unique()->uuid,
            'id_passenger' => \App\Models\Passenger::factory(),
            'id_driver' => \App\Models\Driver::factory(),
            'license_plate' => \App\Models\Vehicle::factory(),
            'start_point' => $this->faker->address,
            'end_point' => $this->faker->address,
            'start_datetime' => $this->faker->dateTime,
            'end_datetime' => $this->faker->optional()->dateTime,
            'fare' => $this->faker->randomFloat(2, 10, 100),
            'trip_status' => $this->faker->randomElement(['completed', 'ongoing', 'canceled']),
            'rating' => $this->faker->optional()->randomFloat(1, 1, 5),
        ];
    }
}
