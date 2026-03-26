<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ManufacturerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'country' => $this->faker->country(),
            'contact_info' => str($this->faker->randomElement(['+254', '254', '0']))->append($this->faker->randomElement(['7', '1']))->append($this->faker->numerify('########'))->value(),
        ];
    }
}
