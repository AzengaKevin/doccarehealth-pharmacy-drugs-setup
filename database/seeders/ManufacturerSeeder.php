<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Pfizer Inc.',
                'country' => 'United States',
            ],
            [
                'name' => 'Johnson & Johnson',
                'country' => 'United States',
            ],
            [
                'name' => 'Roche Holding AG',
                'country' => 'Switzerland',
            ],
            [
                'name' => 'Novartis AG',
                'country' => 'Switzerland',
            ],
            [
                'name' => 'Merck & Co., Inc.',
                'country' => 'United States',
            ],
            [
                'name' => 'Sanofi S.A.',
                'country' => 'France',
            ],
            [
                'name' => 'GlaxoSmithKline plc',
                'country' => 'United Kingdom',
            ],
            [
                'name' => 'AstraZeneca plc',
                'country' => 'United Kingdom',
            ],
            [
                'name' => 'Bristol-Myers Squibb Company',
                'country' => 'United States',
            ],
            [
                'name' => 'Eli Lilly and Company',
                'country' => 'United States',
            ],
        ];

        collect($data)->each(fn ($item) => Manufacturer::query()->updateOrCreate($item));
    }
}
