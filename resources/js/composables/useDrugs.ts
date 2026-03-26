import { destroy as drugsDestroy } from '@/routes/drugs';
import { router } from '@inertiajs/vue3';
import type Drug from '@/types/drug';

export default function useDrugs() {
    const deleteDrug = (drug: Drug) => {
        if (
            confirm(
                `Are you sure you want to delete the drug "${drug.name}"? This action cannot be undone.`,
            )
        ) {
            router.delete(drugsDestroy(drug.id).url, {
                preserveState: true,
                replace: true,
            });
        }
    };

    return {
        deleteDrug,
    };
}
