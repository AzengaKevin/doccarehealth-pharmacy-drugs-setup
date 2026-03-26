<?php

namespace App\Http\Requests;

use App\Models\DosageForm;
use App\Models\Drug;
use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDrugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'generic_name' => ['nullable', 'string', 'max:255'],
            'brand_name' => ['nullable', 'string', 'max:255', Rule::unique(Drug::class, 'brand_name')],
            'description' => ['nullable', 'string'],
            'therapeutic_class' => ['nullable', 'string', 'max:255'],
            'pharmacological_class' => ['nullable', 'string', 'max:255'],
            'atc_code' => ['nullable', 'string', 'max:255'],
            'dosage_form' => ['nullable', Rule::exists(DosageForm::class, 'id')],
            'strength' => ['nullable', 'string', 'max:255'],
            'route_of_administration' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable', Rule::exists(Manufacturer::class, 'id')],
            'is_prescription_required' => ['nullable', 'boolean'],
            'is_controlled_substance' => ['nullable', 'boolean'],
            'barcode' => ['nullable', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255'],
            'unit_of_measure' => ['nullable', 'string', 'max:255'],
            'pack_size' => ['nullable', 'numeric'],
            'side_effects' => ['nullable', 'string'],
            'contraindications' => ['nullable', 'string'],
            'drug_interactions' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:255'],
        ];
    }
}
