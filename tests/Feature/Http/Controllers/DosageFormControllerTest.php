<?php

namespace Tests\Feature\Http\Controllers;

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
        $response = $this->actingAs($this->user)->get(route('dosage-forms.index'));

        $response->assertStatus(200);

        $response->assertInertia(
            fn ($page) => $page
                ->component('dosage-forms/IndexPage')
                ->has('forms.data', 0)
        );
    }
}
