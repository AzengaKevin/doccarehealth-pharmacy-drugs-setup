<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\DosageForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DosageFormControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_dosage_forms_index_route(): void
    {
        DosageForm::factory()->count($howMany = 2)->create();

        $response = $this->actingAs($this->user)->get(route('dosage-forms.index'));

        $response->assertStatus(200);

        $response->assertInertia(
            fn ($page) => $page
                ->component('dosage-forms/IndexPage')
                ->has('forms.data', $howMany)
        );
    }

    public function test_dosage_forms_store_route(): void
    {
        $payload = [
            'name' => $this->faker->unique()->word(),
        ];

        $response = $this->actingAs($this->user)->post(route('dosage-forms.store'), $payload);

        $response->assertStatus(302);

        $response->assertRedirect(route('dosage-forms.index'));

        $this->assertDatabaseHas(DosageForm::class, [
            'name' => data_get($payload, 'name'),
        ]);
    }

    public function test_dosage_forms_update_route(): void
    {
        $form = DosageForm::factory()->create();

        $payload = [
            'name' => $this->faker->unique()->word(),
        ];

        $response = $this->actingAs($this->user)->put(route('dosage-forms.update', $form), $payload);

        $response->assertStatus(302);

        $response->assertRedirect(route('dosage-forms.index'));

        $this->assertDatabaseHas(DosageForm::class, [
            'id' => $form->id,
            'name' => data_get($payload, 'name'),
        ]);
    }

    public function test_dosage_forms_destroy_route(): void
    {
        $form = DosageForm::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('dosage-forms.destroy', $form));

        $response->assertStatus(302);

        $response->assertRedirect(route('dosage-forms.index'));

        $this->assertSoftDeleted(DosageForm::class, [
            'id' => $form->id,
        ]);
    }
}
