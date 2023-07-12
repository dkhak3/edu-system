<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lecturer_name' => fake()->name(),
            'lecturer_address' => fake()->address(),
            'lecturer_phone' => fake()->phoneNumber(),
            'lecturer_birthday' => fake()->date(),
        ];
    }
}
