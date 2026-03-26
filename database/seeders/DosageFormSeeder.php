<?php

namespace Database\Seeders;

use App\Models\DosageForm;
use Illuminate\Database\Seeder;

class DosageFormSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Tablet',
            'Capsule',
            'Syrup',
            'Injection',
            'Cream',
            'Drops',
        ];

        collect($data)->each(fn ($name) => DosageForm::query()->updateOrCreate(compact('name')));
    }
}
