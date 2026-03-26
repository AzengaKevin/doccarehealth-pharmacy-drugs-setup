<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DosageFormFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Tablet', 'Capsule', 'Syrup', 'Injection']),
        ];
    }
}
