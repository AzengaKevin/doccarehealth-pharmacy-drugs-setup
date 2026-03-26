<?php

namespace Tests\Feature\Models;

use App\Models\DosageForm;
use App\Models\Drug;
use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_creating_a_new_drug(): void
    {
        $dosageForm = DosageForm::factory()->create();

        $manufacturer = Manufacturer::factory()->create();

        $attributes = [
            'dosage_form_id' => $dosageForm->id,
            'manufacturer_id' => $manufacturer->id,
            'generic_name' => $this->faker->sentence(),
            'brand_name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'strength' => $this->faker->randomElement(['10mg', '20mg', '50mg', '100mg', '250mg', '500mg', '1g']),
            'unit_of_measure' => $this->faker->randomElement(['tablet', 'capsule', 'syrup', 'injection']),
        ];

        $drug = Drug::query()->create($attributes);

        $this->assertDatabaseHas(Drug::class, [
            'id' => $drug->id,
            'generic_name' => $attributes['generic_name'],
            'brand_name' => $attributes['brand_name'],
            'description' => $attributes['description'],
            'strength' => $attributes['strength'],
            'unit_of_measure' => $attributes['unit_of_measure'],
        ]);
    }

    public function test_creating_a_drug_with_factory(): void
    {
        $drug = Drug::factory()->create();

        $this->assertDatabaseHas(Drug::class, [
            'id' => $drug->id,
            'generic_name' => $drug->generic_name,
            'brand_name' => $drug->brand_name,
            'description' => $drug->description,
            'strength' => $drug->strength,
            'unit_of_measure' => $drug->unit_of_measure,
        ]);
    }
}
