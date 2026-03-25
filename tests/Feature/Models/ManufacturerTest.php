<?php

namespace Tests\Feature\Models;

use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManufacturerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_creating_a_manufacturer(): void
    {
        $attributes = [
            'name' => $this->faker->company(),
            'country' => $this->faker->countryCode(),
            'contact_info' => str($this->faker->randomElement(['+254', '254', '0']))->append($this->faker->randomElement(['7', '1']))->append($this->faker->numerify('########'))->value(),
        ];

        $manufacturer = Manufacturer::query()->create($attributes);

        $this->assertDatabaseHas(Manufacturer::class, [
            'id' => $manufacturer->id,
            'name' => $attributes['name'],
            'country' => $attributes['country'],
            'contact_info' => $attributes['contact_info'],
        ]);
    }
}
