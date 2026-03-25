<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_creating_a_new_drug(): void
    {
        $attributes = [

            'generic_name' => $this->faker->sentence(3),
            'brand_name' => $this->faker->sentence(2),

            'paragraph' => $this->faker->paragraph(),
        ];
        
    }
}
