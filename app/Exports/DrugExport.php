<?php

namespace App\Exports;

use App\Models\Drug;
use App\Services\DrugService;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class DrugExport extends StringValueBinder implements FromCollection, ShouldAutoSize, WithCustomValueBinder, WithHeadings
{
    use Exportable;

    public function __construct(private array $data = []) {}

    public function headings(): array
    {
        return [
            'generic_name',
            'brand_name',
            'description',
            'therapeutic_class',
            'pharmacological_class',
            'atc_code',
            'dosage_form',
            'strength',
            'route_of_administration',
            'manufacturer',
            'is_prescription_required',
            'is_controlled_substance',
            'barcode',
            'sku',
            'unit_of_measure',
            'pack_size',
            'side_effects',
            'contraindications',
            'drug_interactions',
            'status',
        ];
    }

    public function collection()
    {
        return app(DrugService::class)->get(...$this->data, with: ['dosageForm', 'manufacturer'])->map(fn (Drug $drug) => [
            'generic_name' => $drug->generic_name,
            'brand_name' => $drug->brand_name,
            'description' => $drug->description,
            'therapeutic_class' => $drug->therapeutic_class,
            'pharmacological_class' => $drug->pharmacological_class,
            'atc_code' => $drug->atc_code,
            'dosage_form' => $drug->dosageForm?->name,
            'strength' => $drug->strength,
            'route_of_administration' => $drug->route_of_administration,
            'manufacturer' => $drug->manufacturer?->name,
            'is_prescription_required' => $drug->is_prescription_required,
            'is_controlled_substance' => $drug->is_controlled_substance,
            'barcode' => $drug->barcode,
            'sku' => $drug->sku,
            'unit_of_measure' => $drug->unit_of_measure,
            'pack_size' => $drug->pack_size,
            'side_effects' => $drug->side_effects,
            'contraindications' => $drug->contraindications,
            'drug_interactions' => $drug->drug_interactions,
            'status' => $drug->status ? $drug->status->value : null,
        ]);
    }
}
