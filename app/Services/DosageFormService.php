<?php

namespace App\Services;

use App\Models\DosageForm;

class DosageFormService
{
    public function get(
        ?string $query = null,
        ?int $perPage = 24,
        string $sortBy = 'name',
        string $sortDirection = 'asc'
    ) {
        $dosageFormQuery = DosageForm::search($query)
            ->orderBy($sortBy, $sortDirection);

        return is_null($perPage) ? $dosageFormQuery->get() : $dosageFormQuery->paginate($perPage);
    }
}
