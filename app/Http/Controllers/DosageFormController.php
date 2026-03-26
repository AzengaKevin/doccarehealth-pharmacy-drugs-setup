<?php

namespace App\Http\Controllers;

use App\Services\DosageFormService;
use Illuminate\Http\Request;

class DosageFormController extends Controller
{
    public function __construct(private readonly DosageFormService $dosageFormService) {}

    public function index(Request $request)
    {
        $params = $request->only(['query', 'perPage', 'sortBy', 'sortDirection']);

        return inertia('dosage-forms/IndexPage', [
            'forms' => $this->dosageFormService->get(...$params),
            'params' => $params,
        ]);
    }
}
