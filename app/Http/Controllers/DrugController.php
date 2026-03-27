<?php

namespace App\Http\Controllers;

use App\Exports\DrugExport;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\StoreDrugRequest;
use App\Http\Requests\UpdateDrugRequest;
use App\Http\Responses\Concerns\RedirectWithFeedback;
use App\Imports\DrugImport;
use App\Models\Drug;
use App\Services\DosageFormService;
use App\Services\DrugService;
use App\Services\ImportService;
use App\Services\ManufacturerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DrugController extends Controller
{
    use ImportService, RedirectWithFeedback;

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

    public function edit(Drug $drug)
    {
        return Inertia::render('drugs/EditPage', [
            'drug' => $drug,
            'forms' => $this->dosageFormService->get(perPage: null),
            'manufacturers' => $this->manufacturerService->get(perPage: null),
        ]);
    }

    public function update(UpdateDrugRequest $updateDrugRequest, Drug $drug)
    {
        $data = $updateDrugRequest->validated();

        try {

            $data['dosage_form_id'] = data_get($data, 'dosage_form');

            $data['manufacturer_id'] = data_get($data, 'manufacturer');

            $data['is_prescription_required'] = $updateDrugRequest->boolean('is_prescription_required');

            $data['is_controlled_substance'] = $updateDrugRequest->boolean('is_controlled_substance');

            $this->drugService->update($drug, $data);

            return $this->sendSuccessRedirect("You've successfully updated the drug, {$drug->name}", route('drugs.show', $drug));
        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to update the drug', $throwable);
        }
    }

    public function destroy(Drug $drug)
    {
        try {

            $this->drugService->delete($drug);

            return $this->sendSuccessRedirect("You've successfully deleted the drug, {$drug->name}", route('drugs.index'));
        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to delete the drug', $throwable);
        }
    }

    public function export(Request $request)
    {
        $params = $request->only('query', 'perPage', 'sortBy', 'sortDirectiton');

        $loanExport = new DrugExport(...$params);

        $filename = Drug::getExportFilename();

        return $loanExport->download($filename);
    }

    public function import(ImportRequest $importRequest): RedirectResponse
    {
        $data = $importRequest->validated();

        try {

            $this->robustImport(new DrugImport, $data['file'], 'drugs', 'drugs');

            return $this->sendSuccessRedirect('Imported drugs successfully.', route('drugs.index'));

        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to import drugs data', $throwable);
        }
    }
}
