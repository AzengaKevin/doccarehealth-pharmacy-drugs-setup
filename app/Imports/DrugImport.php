<?php

namespace App\Imports;

use App\Models\DosageForm;
use App\Models\Drug;
use App\Models\Manufacturer;
use App\Services\DrugService;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class DrugImport extends StringValueBinder implements OnEachRow, SkipsEmptyRows, SkipsOnError, SkipsOnFailure, WithHeadingRow, WithStartRow, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;

    public function __construct(private array $meta = []) {}

    public function startRow(): int
    {
        return 2;
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
            'dosage_form' => ['nullable'],
            'strength' => ['nullable', 'string', 'max:255'],
            'route_of_administration' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable'],
            'is_prescription_required' => ['nullable', 'boolean'],
            'is_controlled_substance' => ['nullable', 'boolean'],
            'barcode' => ['nullable', 'max:255'],
            'sku' => ['nullable', 'max:255'],
            'unit_of_measure' => ['nullable', 'max:255'],
            'pack_size' => ['nullable', 'numeric'],
            'side_effects' => ['nullable'],
            'contraindications' => ['nullable'],
            'drug_interactions' => ['nullable'],
            'status' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function onRow(Row $row)
    {

        $data = $row->toArray();

        if ($dosageFormName = data_get($data, 'dosage_form')) {

            $dosageForm = DosageForm::query()->updateOrCreate(['name' => trim($dosageFormName)]);

            $data['dosage_form_id'] = $dosageForm->id;
        }

        if ($manufacturerName = data_get($data, 'manufacturer')) {

            $manufacturer = Manufacturer::query()->updateOrCreate(['name' => trim($manufacturerName)]);

            $data['manufacturer_id'] = $manufacturer->id;
        }

        app(DrugService::class)->importRow($data);
    }
}
