<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DrugFactory extends Factory
{
    public function definition(): array
    {
        return [
            'generic_name' => $this->faker->sentence(),
            'brand_name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'strength' => $this->faker->randomElement(['10mg', '20mg', '50mg', '100mg', '250mg', '500mg', '1g']),
            'unit_of_measure' => $this->faker->randomElement(['tablet', 'capsule', 'syrup', 'injection']),
        ];
    }
}
