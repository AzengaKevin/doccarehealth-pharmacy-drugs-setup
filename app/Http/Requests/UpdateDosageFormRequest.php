<?php

namespace App\Http\Requests;

use App\Models\DosageForm;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDosageFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosageForm = $this->route('dosageForm');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(DosageForm::class, 'name')->ignore($dosageForm->id)],
        ];
    }
}
