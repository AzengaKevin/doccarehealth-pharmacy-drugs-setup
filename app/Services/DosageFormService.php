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

    public function create(array $data): DosageForm
    {
        $attributes = [
            'name' => data_get($data, 'name'),
        ];

        return DosageForm::query()->create($attributes);
    }

    public function update(DosageForm $dosageForm, array $data): bool
    {
        $attributes = [
            'name' => data_get($data, 'name'),
        ];

        return $dosageForm->update($attributes);
    }

    public function delete(DosageForm $dosageForm): ?bool
    {
        return $dosageForm->delete();
    }
}
