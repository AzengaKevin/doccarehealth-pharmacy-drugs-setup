<?php

namespace Database\Seeders;

use App\Models\DosageForm;
use App\Models\Drug;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class DrugSeeder extends Seeder
{
    public function run(): void
    {
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

        collect($data)->each(function ($item) {

            $manufacturer = Manufacturer::where('name', $item['manufacturer'])->first();

            $dosageForm = DosageForm::where('name', $item['dosage_form'])->first();

            $attributes = [
                'generic_name' => data_get($item, 'generic_name'),
                'brand_name' => data_get($item, 'brand_name'),
            ];

            $values = [
                'manufacturer_id' => $manufacturer->id,
                'dosage_form_id' => $dosageForm->id,
                'description' => data_get($item, 'description'),
                'therapeutic_class' => data_get($item, 'therapeutic_class'),
                'pharmacological_class' => data_get($item, 'pharmacological_class'),
                'atc_code' => data_get($item, 'atc_code'),
                'strength' => data_get($item, 'strength'),
                'route_of_administration' => data_get($item, 'route_of_administration'),
                'is_prescription_required' => data_get($item, 'is_prescription_required'),
                'is_controlled_substance' => data_get($item, 'is_controlled_substance'),
                'barcode' => data_get($item, 'barcode'),
                'sku' => data_get($item, 'sku'),
                'unit_of_measure' => data_get($item, 'unit_of_measure'),
                'pack_size' => data_get($item, 'pack_size'),
                'side_effects' => data_get($item, 'side_effects'),
                'contraindications' => data_get($item, 'contraindications'),
                'drug_interactions' => data_get($item, 'drug_interactions'),
                'status' => data_get($item, 'status'),
            ];

            Drug::query()->updateOrCreate($attributes, $values);

        });
    }
}
