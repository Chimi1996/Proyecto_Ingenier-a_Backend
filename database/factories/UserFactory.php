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
            'phone_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'second_last_name' => $this->faker->optional()->lastName,
            'password' => Hash::make('password'), // Usar Hash::make para hashear la contraseña
            'country_code' => '+506', // Ejemplo, ajusta esto según tus necesidades
            'authy_id' => '847030', // Ejemplo, ajusta cómo generas o asignas el authy_id
            'verified' => $this->faker->boolean(), // Puedes ajustar cómo determinas si está verificado
            'user_type' => $this->faker->randomElement(['driver', 'passenger']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


}
