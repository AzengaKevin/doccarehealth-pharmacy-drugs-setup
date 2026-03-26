import { destroy as dosageFormsDestroy } from '@/routes/dosage-forms';
import { router } from '@inertiajs/vue3';
import type DosageForm from '@/types/dosage-form';

export default function useDosageForms() {
    const deleteDosageForm = (form: DosageForm) => {
        if (
            confirm(
                `Are you sure you want to delete the dosage form "${form.name}"? This action cannot be undone.`,
            )
        ) {
            router.delete(dosageFormsDestroy(form.id).url, {
                preserveState: true,
                replace: true,
            });
        }
    };

    return {
        deleteDosageForm,
    };
}
