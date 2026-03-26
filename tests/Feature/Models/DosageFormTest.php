<?php

namespace Tests\Feature\Models;

use App\Models\DosageForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DosageFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_creating_dosage_form(): void
    {
        $attributes = [
            'name' => $this->faker->randomElement(['Tablet', 'Capsule', 'Syrup', 'Injection']),
        ];

        $dosageForm = DosageForm::create($attributes);

        $this->assertDatabaseHas(DosageForm::class, [
            'id' => $dosageForm->id,
            'name' => $attributes['name'],
        ]);

        $this->assertInstanceOf(DosageForm::class, $dosageForm);
    }

    public function test_creating_dosage_form_from_factory(): void
    {
        $dosageForm = DosageForm::factory()->create();

        $this->assertDatabaseHas(DosageForm::class, [
            'id' => $dosageForm->id,
            'name' => $dosageForm->name,
        ]);

        $this->assertInstanceOf(DosageForm::class, $dosageForm);
    }
}
