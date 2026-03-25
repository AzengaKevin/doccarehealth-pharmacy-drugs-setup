<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_creating_a_new_user(): void
    {
        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password = $this->faker->password(minLength: 8),
        ];

        $user = User::create($attributes);

        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);

        $this->assertTrue(Hash::check($password, $user->password));
    }
}
