<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\DosageForm;
use App\Models\Drug;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_drugs_index_route(): void
    {
        Drug::factory()->for(Manufacturer::factory())
            ->has(DosageForm::factory())
            ->count($howMany = 3)
            ->create();

        $response = $this->actingAs($this->user)->get(route('drugs.index'));

        $response->assertStatus(200);

        $response->assertInertia(fn ($page) => $page->component('drugs/IndexPage')->has('drugs.data', $howMany));
    }

    public function test_drugs_create_route(): void
    {
        DosageForm::factory()->count(2)->create();

        Manufacturer::factory()->count(2)->create();

        $response = $this->actingAs($this->user)->get(route('drugs.create'));

        $response->assertOk();

        $response->assertInertia(fn ($page) => $page->component('drugs/CreatePage')->has('forms')->has('manufacturers'));
    }

    public function test_drugs_store_route(): void
    {
        $dosageForm = DosageForm::factory()->create();

        $manufacturer = Manufacturer::factory()->create();

        $payload = [
            'generic_name' => $this->faker->sentence(),
            'brand_name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'strength' => $this->faker->randomElement(['10mg', '20mg', '50mg', '100mg', '250mg', '500mg', '1g']),
            'unit_of_measure' => $this->faker->randomElement(['tablet', 'capsule', 'syrup', 'injection']),
            'dosage_form' => $dosageForm->id,
            'manufacturer' => $manufacturer->id,
        ];

        $response = $this->actingAs($this->user)->post(route('drugs.store'), $payload);

        $response->assertRedirect();

        $this->assertDatabaseHas(Drug::class, [
            'generic_name' => data_get($payload, 'generic_name'),
            'brand_name' => data_get($payload, 'brand_name'),
            'description' => data_get($payload, 'description'),
            'strength' => data_get($payload, 'strength'),
            'unit_of_measure' => data_get($payload, 'unit_of_measure'),
            'dosage_form_id' => data_get($payload, 'dosage_form'),
            'manufacturer_id' => data_get($payload, 'manufacturer'),
        ]);
    }

    public function test_drugs_show_routes(): void
    {
        $drug = Drug::factory()->for(Manufacturer::factory())->for(DosageForm::factory())->create();

        $response = $this->actingAs($this->user)->get(route('drugs.show', $drug));

        $response->assertStatus(200);

        $response->assertInertia(fn ($page) => $page->component('drugs/ShowPage')->has('drug'));
    }
}
