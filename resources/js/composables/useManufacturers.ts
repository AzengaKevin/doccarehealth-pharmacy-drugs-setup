import { destroy as manufacturersDestroy } from '@/routes/manufacturers';
import { router } from '@inertiajs/vue3';
import type Manufacturer from '@/types/manufacturer';

export default function useManufacturers() {
    const deleteManufacturer = (manufacturer: Manufacturer) => {
        if (
            confirm(
                `Are you sure you want to delete the manufacturer "${manufacturer.name}"? This action cannot be undone.`,
            )
        ) {
            router.delete(manufacturersDestroy(manufacturer.id).url, {
                preserveState: true,
                replace: true,
            });
        }
    };

    return {
        deleteManufacturer,
    };
}
