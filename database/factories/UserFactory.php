<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->unique()->userName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'second_last_name' => $this->faker->optional()->lastName,
            'password' => Hash::make('password'), // Usar Hash::make para hashear la contraseña
            'phone_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'user_type' => $this->faker->randomElement(['driver', 'passenger']),
        ];
    }


}
