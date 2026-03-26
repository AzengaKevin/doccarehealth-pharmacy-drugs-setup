<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Http\Responses\Concerns\RedirectWithFeedback;
use App\Models\Manufacturer;
use App\Services\ManufacturerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManufacturerController extends Controller
{
    use RedirectWithFeedback;

    public function __construct(private readonly ManufacturerService $manufacturerService) {}

    public function index(Request $request)
    {
        $params = $request->only('query', 'perPage', 'sortBy', 'sortDirection');

        $manufacturers = $this->manufacturerService->get(...$params);

        return Inertia::render('manufacturers/IndexPage', [
            'manufacturers' => $manufacturers,
            'params' => $params,
        ]);
    }

    public function store(StoreManufacturerRequest $storeManufacturerRequest)
    {
        $data = $storeManufacturerRequest->validated();

        try {

            $this->manufacturerService->create($data);

            return $this->sendSuccessRedirect('The Manufacturer has been successfully created.', route('manufacturers.index'));
        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to create the manufactuere', $throwable);
        }
    }

    public function update(UpdateManufacturerRequest $updateManufacturerRequest, Manufacturer $manufacturer)
    {
        $data = $updateManufacturerRequest->validated();

        try {

            $this->manufacturerService->update($manufacturer, $data);

            return $this->sendSuccessRedirect('The Manufacturer has been successfully updated.', route('manufacturers.index'));

        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to update the manufactuere', $throwable);
        }
    }

    public function destroy(Manufacturer $manufacturer)
    {
        try {

            $this->manufacturerService->delete($manufacturer);

            return $this->sendSuccessRedirect('The Manufacturer has been successfully deleted.', route('manufacturers.index'));

        } catch (\Throwable $throwable) {

            return $this->sendErrorRedirect('Failed to delete the manufactuere', $throwable);
        }
    }
}
