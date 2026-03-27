<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrugRequest;
use App\Http\Responses\Concerns\RedirectWithFeedback;
use App\Models\Drug;
use App\Services\DosageFormService;
use App\Services\DrugService;
use App\Services\ManufacturerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DrugController extends Controller
{
    use RedirectWithFeedback;

    public function __construct(
        private readonly DrugService $drugService,
        private readonly ManufacturerService $manufacturerService,
        private readonly DosageFormService $dosageFormService,
    ) {}

    public function index(Request $request)
    {
        $params = $request->only('query', 'perPage', 'sortBy', 'sortDirectiton');

        $drugs = $this->drugService->get(...$params);

        return Inertia::render('drugs/IndexPage', [
            'drugs' => $drugs,
            'params' => $params,
        ]);
    }

    public function create()
    {
        return Inertia::render('drugs/CreatePage', [
            'forms' => $this->dosageFormService->get(perPage: null),
            'manufacturers' => $this->manufacturerService->get(perPage: null),
        ]);
    }

    public function store(StoreDrugRequest $storeDrugRequest)
    {
        $data = $storeDrugRequest->validated();

        try {

            $data['dosage_form_id'] = data_get($data, 'dosage_form');

            $data['manufacturer_id'] = data_get($data, 'manufacturer');

            $data['is_prescription_required'] = $storeDrugRequest->boolean('is_prescription_required');

            $data['is_controlled_substance'] = $storeDrugRequest->boolean('is_controlled_substance');

            $drug = $this->drugService->create($data);

            return $this->sendSuccessRedirect("You've successfully created the drug, {$drug->name}", route('drugs.index'));
        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to create the drug', $throwable);
        }
    }

    public function show(Drug $drug)
    {
        return Inertia::render('drugs/ShowPage', [
            'drug' => $drug,
        ]);
    }
}
