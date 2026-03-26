<?php

namespace App\Services;

use App\Models\Manufacturer;

class ManufacturerService
{
    public function get(
        ?string $query = null,
        ?int $perPage = 48,
        ?string $sortBy = 'created_at',
        ?string $sortDirection = 'desc'
    ) {
        $manufacturersQuery = Manufacturer::search($query)->orderBy($sortBy, $sortDirection);

        return is_null($perPage) ? $manufacturersQuery->get() : $manufacturersQuery->paginate($perPage);
    }

    public function create(array $data): Manufacturer
    {
        $attributes = [
            'name' => data_get($data, 'name'),
            'country' => data_get($data, 'country'),
            'contact_info' => data_get($data, 'contact_info'),
        ];

        return Manufacturer::query()->create($attributes);
    }

    public function update(Manufacturer $manufacturer, array $data): bool
    {
        $attributes = [
            'name' => data_get($data, 'name'),
            'country' => data_get($data, 'country'),
            'contact_info' => data_get($data, 'contact_info'),
        ];

        return $manufacturer->update($attributes);
    }

    public function delete(Manufacturer $manufacturer): ?bool
    {
        return $manufacturer->delete();
    }
}
