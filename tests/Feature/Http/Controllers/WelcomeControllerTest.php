<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_welcome_route(): void
    {
        $response = $this->get(route('welcome'));

        $response->assertStatus(200);

        $response->assertInertia(
            fn ($page) => $page
                ->component('WelcomePage')
                ->where('canRegister', true)
        );
    }
}
