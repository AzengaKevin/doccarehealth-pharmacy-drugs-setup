<?php

namespace App\Services;

use App\Enum\DrugStatus;
use App\Models\Drug;

class DrugService
{
    public function get(
        ?string $query = null,
        ?int $perPage = 48,
        ?string $sortBy = 'created_at',
        ?string $sortDirection = 'desc'
    ) {

        $drugQuery = Drug::search($query)->orderBy($sortBy, $sortDirection);

        return is_null($perPage)
            ? $drugQuery->get()
            : $drugQuery->paginate();
    }

    public function create(array $data): Drug
    {

        $attributes = [
            'generic_name' => data_get($data, 'generic_name'),
            'brand_name' => data_get($data, 'brand_name'),
            'description' => data_get($data, 'description'),
            'therapeutic_class' => data_get($data, 'therapeutic_class'),
            'pharmacological_class' => data_get($data, 'pharmacological_class'),
            'atc_code' => data_get($data, 'atc_code'),
            'dosage_form_id' => data_get($data, 'dosage_form_id'),
            'strength' => data_get($data, 'strength'),
            'route_of_administration' => data_get($data, 'route_of_administration'),
            'manufacturer_id' => data_get($data, 'manufacturer_id'),
            'is_prescription_required' => data_get($data, 'is_prescription_required', true),
            'is_controlled_substance' => data_get($data, 'is_controlled_substance', false),
            'barcode' => data_get($data, 'barcode'),
            'sku' => data_get($data, 'sku'),
            'unit_of_measure' => data_get($data, 'unit_of_measure'),
            'pack_size' => data_get($data, 'pack_size'),
            'side_effects' => data_get($data, 'side_effects'),
            'contraindications' => data_get($data, 'contraindications'),
            'drug_interactions' => data_get($data, 'drug_interactions'),
            // 'status' => data_get($data, 'status', DrugStatus::ACTIVE->value),
        ];

        return Drug::query()->create($attributes);
    }
}
