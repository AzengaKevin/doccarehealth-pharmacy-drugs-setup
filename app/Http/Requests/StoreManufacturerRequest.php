<?php

namespace App\Http\Requests;

use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManufacturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(Manufacturer::class, 'name')],
            'country' => ['nullable', 'string', 'max:255'],
            'contact_info' => ['nullable', 'string', 'max:255', Rule::unique(Manufacturer::class, 'contact_info')],
        ];
    }
}
