<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Azenga Kevin',
            'email' => 'azenga.kevin7@gmail.com',
            'password' => 'turtledove',
        ]);
    }
}
