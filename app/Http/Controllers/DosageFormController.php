<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosageFormRequest;
use App\Http\Requests\UpdateDosageFormRequest;
use App\Http\Responses\Concerns\RedirectWithFeedback;
use App\Models\DosageForm;
use App\Services\DosageFormService;
use Illuminate\Http\Request;

class DosageFormController extends Controller
{
    use RedirectWithFeedback;

    public function __construct(private readonly DosageFormService $dosageFormService) {}

    public function index(Request $request)
    {
        $params = $request->only(['query', 'perPage', 'sortBy', 'sortDirection']);

        return inertia('dosage-forms/IndexPage', [
            'forms' => $this->dosageFormService->get(...$params),
            'params' => $params,
        ]);
    }

    public function store(StoreDosageFormRequest $storeDosageFormRequest)
    {
        $data = $storeDosageFormRequest->validated();

        try {

            $this->dosageFormService->create($data);

            return $this->sendSuccessRedirect('Dosage form created successfully.', route('dosage-forms.index'));
        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to create dosage form.', $throwable);
        }
    }

    public function update(UpdateDosageFormRequest $updateDosageFormRequest, DosageForm $dosageForm)
    {
        $data = $updateDosageFormRequest->validated();

        try {

            $this->dosageFormService->update($dosageForm, $data);

            return $this->sendSuccessRedirect('Dosage form updated successfully.', route('dosage-forms.index'));

        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to update dosage form.', $throwable);
        }
    }
}
