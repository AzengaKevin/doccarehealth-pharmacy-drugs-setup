<?php

namespace Tests\Feature\Imports;

use App\Imports\DrugImport;
use App\Models\Drug;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\Feature\Traits\WithTestImports;
use Tests\TestCase;

class DrugImportTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithTestImports;

    public function test_importing_drugs(): void
    {

        $titlesRow = [
            'generic_name',
            'brand_name',
            'manufacturer',
            'dosage_form',
            'strength',
            'description',
            'therapeutic_class',
            'pharmacological_class',
            'atc_code',
            'route_of_administration',
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

        $now = now('Africa/Nairobi');

        $data = [
            [
                'generic_name' => 'Paracetamol',
                'brand_name' => 'Tylenol',
                'manufacturer' => 'Johnson & Johnson',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'description' => 'Used to treat pain and fever.',
                'therapeutic_class' => 'Analgesic',
                'pharmacological_class' => 'Non-opioid analgesic',
                'atc_code' => 'N02BE01',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => false,
                'is_controlled_substance' => false,
                'barcode' => '1234567890123',
                'sku' => 'PARA-500',
                'unit_of_measure' => 'mg',
                'pack_size' => '20',
                'side_effects' => 'Nausea, rash, liver damage (in overdose)',
                'contraindications' => 'Severe liver disease, allergy to paracetamol',
                'drug_interactions' => 'Alcohol, warfarin',
                'status' => 'active',
            ],
            [
                'generic_name' => 'Amoxicillin',
                'brand_name' => 'Amoxil',
                'manufacturer' => 'GlaxoSmithKline plc',
                'dosage_form' => 'Capsule',
                'strength' => '250mg',
                'description' => 'Used to treat bacterial infections.',
                'therapeutic_class' => 'Antibiotic',
                'pharmacological_class' => 'Penicillin',
                'atc_code' => 'J01CA04',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => true,
                'is_controlled_substance' => false,
                'barcode' => '9876543210123',
                'sku' => 'AMOX-250',
                'unit_of_measure' => 'mg',
                'pack_size' => '30',
                'side_effects' => 'Diarrhea, rash, allergic reactions',
                'contraindications' => 'Allergy to penicillins, mononucleosis',
                'drug_interactions' => 'Methotrexate, oral contraceptives',
                'status' => 'active',
            ],
            [
                'generic_name' => 'Ibuprofen',
                'brand_name' => 'Advil',
                'manufacturer' => 'Pfizer Inc.',
                'dosage_form' => 'Tablet',
                'strength' => '200mg',
                'description' => 'Used to reduce fever and treat pain or inflammation.',
                'therapeutic_class' => 'Nonsteroidal anti-inflammatory drug (NSAID)',
                'pharmacological_class' => 'NSAID',
                'atc_code' => 'M01AE01',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => false,
                'is_controlled_substance' => false,
                'barcode' => '5555555555555',
                'sku' => 'IBUP-200',
                'unit_of_measure' => 'mg',
                'pack_size' => '24',
                'side_effects' => 'Upset stomach, dizziness, rash',
                'contraindications' => 'Peptic ulcer disease, severe heart failure, allergy to NSAIDs',
                'drug_interactions' => 'Aspirin, blood thinners, antihypertensives',
                'status' => 'active',
            ],
            [
                'generic_name' => 'Metformin',
                'brand_name' => 'Glucophage',
                'manufacturer' => 'Merck & Co., Inc.',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'description' => 'Used to treat type 2 diabetes.',
                'therapeutic_class' => 'Antidiabetic',
                'pharmacological_class' => 'Biguanide',
                'atc_code' => 'A10BA02',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => true,
                'is_controlled_substance' => false,
                'barcode' => '4444444444444',
                'sku' => 'MET-500',
                'unit_of_measure' => 'mg',
                'pack_size' => '60',
                'side_effects' => 'Nausea, diarrhea, lactic acidosis (rare)',
                'contraindications' => 'Severe kidney disease, metabolic acidosis, allergy to metformin',
                'drug_interactions' => 'Alcohol, iodinated contrast agents, cimetidine',
                'status' => 'active',
            ],
            [
                'generic_name' => 'Lisinopril',
                'brand_name' => 'Zestril',
                'manufacturer' => 'Novartis AG',
                'dosage_form' => 'Tablet',
                'strength' => '10mg',
                'description' => 'Used to treat high blood pressure and heart failure.',
                'therapeutic_class' => 'Antihypertensive',
                'pharmacological_class' => 'ACE inhibitor',
                'atc_code' => 'C09AA03',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => true,
                'is_controlled_substance' => false,
                'barcode' => '3333333333333',
                'sku' => 'LISIN-10',
                'unit_of_measure' => 'mg',
                'pack_size' => '30',
                'side_effects' => 'Cough, dizziness, high potassium levels',
                'contraindications' => 'History of angioedema, pregnancy, allergy to ACE inhibitors',
                'drug_interactions' => 'Diuretics, potassium supplements, lithium',
                'status' => 'active',
            ],
            [
                'generic_name' => 'Atorvastatin',
                'brand_name' => 'Lipitor',
                'manufacturer' => 'Pfizer Inc.',
                'dosage_form' => 'Tablet',
                'strength' => '20mg',
                'description' => 'Used to lower cholesterol and reduce the risk of heart disease.',
                'therapeutic_class' => 'Lipid-lowering agent',
                'pharmacological_class' => 'Statin',
                'atc_code' => 'C10AA05',
                'route_of_administration' => 'Oral',
                'is_prescription_required' => true,
                'is_controlled_substance' => false,
                'barcode' => '2222222222222',
                'sku' => 'ATOR-20',
                'unit_of_measure' => 'mg',
                'pack_size' => '30',
                'side_effects' => 'Muscle pain, diarrhea, liver enzyme abnormalities',
                'contraindications' => 'Active liver disease, pregnancy, allergy to atorvastatin',
                'drug_interactions' => 'Other statins, fibrates, cyclosporine',
                'status' => 'active',
            ],
        ];

        $filename = str('drug')->append('-', now()->timestamp, '.csv')->value();

        $filePath = $this->createTestCsvFile($filename, [
            $titlesRow,
            ...$data,
        ]);

        $this->assertFileExists($filePath);

        try {

            $import = new DrugImport;

            $import->import($filePath);

            foreach ($import->failures() as $failure) {

                if (config('app.debug')) {

                    Log::debug($failure->errors());
                }
            }

            foreach ($import->errors() as $throwable) {

                if (config('app.debug')) {

                    Log::debug($throwable->getMessage());
                }
            }

            $this->assertEquals(count($data), Drug::query()->count());

            foreach ($data as $row) {
                $this->assertDatabaseHas(Drug::class, [
                    'generic_name' => data_get($row, 'generic_name'),
                    'brand_name' => data_get($row, 'brand_name'),
                    'description' => data_get($row, 'description'),
                    'strength' => data_get($row, 'strength'),
                    'unit_of_measure' => data_get($row, 'unit_of_measure'),
                ]);
            }
        } finally {

            $this->deleteTestCsvFile($filename);
        }
    }
}
