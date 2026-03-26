<?php

namespace App\Http\Requests;

use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateManufacturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $manufacturer = $this->route('manufacturer');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(Manufacturer::class, 'name')->ignore($manufacturer->id)],
            'country' => ['nullable', 'string', 'max:255'],
            'contact_info' => ['nullable', 'string', 'max:255', Rule::unique(Manufacturer::class, 'contact_info')->ignore($manufacturer->id)],
        ];
    }
}
