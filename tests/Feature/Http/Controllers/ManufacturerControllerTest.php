<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManufacturerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_manufacturers_index_route(): void
    {
        Manufacturer::factory()->count($howMany = 3)->create();

        $response = $this->actingAs($this->user)->get(route('manufacturers.index'));

        $response->assertStatus(200);

        $response->assertInertia(
            fn ($page) => $page->component('manufacturers/IndexPage')->has('manufacturers.data', $howMany)
        );
    }

    public function test_manufacturers_store_route(): void
    {
        $payload = [
            'name' => $this->faker->company(),
            'country' => $this->faker->country(),
            'contact_info' => str($this->faker->randomElement(['+254', '254', '0']))->append($this->faker->randomElement(['7', '1']))->append($this->faker->numerify('########'))->value(),
        ];

        $response = $this->actingAs($this->user)->post(route('manufacturers.store'), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas(Manufacturer::class, [
            'name' => data_get($payload, 'name'),
            'country' => data_get($payload, 'country'),
            'contact_info' => data_get($payload, 'contact_info'),
        ]);
    }

    public function test_manufacturers_update_route(): void
    {
        $manufacturer = Manufacturer::factory()->create();

        $payload = [
            'name' => $this->faker->company(),
            'country' => $this->faker->country(),
            'contact_info' => str($this->faker->randomElement(['+254', '254', '0']))->append($this->faker->randomElement(['7', '1']))->append($this->faker->numerify('########'))->value(),
        ];

        $response = $this->actingAs($this->user)->put(route('manufacturers.update', $manufacturer), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas(Manufacturer::class, [
            'id' => $manufacturer->id,
            'name' => data_get($payload, 'name'),
            'country' => data_get($payload, 'country'),
            'contact_info' => data_get($payload, 'contact_info'),
        ]);
    }

    public function test_manufacturers_destroy_route(): void
    {
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('manufacturers.destroy', $manufacturer));

        $response->assertRedirect();

        $this->assertSoftDeleted(Manufacturer::class, [
            'id' => $manufacturer->id,
        ]);
    }
}
