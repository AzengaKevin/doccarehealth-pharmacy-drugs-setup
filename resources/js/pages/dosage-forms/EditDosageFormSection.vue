<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { update as updateDosageForm } from '@/routes/dosage-forms';
import type DosageForm from '@/types/dosage-form';
import { useForm } from '@inertiajs/vue3';

type EditDosageFormSectionProps = {
    dosageForm?: DosageForm;
};

const props = defineProps<EditDosageFormSectionProps>();

const open = defineModel<boolean>('open');

const form = useForm({
    name: props.dosageForm?.name || '',
});

const submit = () => {
    const dosageFormId = props.dosageForm?.id;

    if (dosageFormId) {
        form.put(updateDosageForm(dosageFormId).url, {
            onSuccess: () => {
                form.reset();
                open.value = false;
            },
            preserveScroll: true,
            preserveState: true,
        });
    }
};
</script>

<template>
    <div>
        <Dialog v-model:open="open">
            <DialogContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <DialogHeader class="space-y-3">
                        <DialogTitle>Edit Dosage Form</DialogTitle>
                        <DialogDescription
                            >Update the details of the dosage
                            form</DialogDescription
                        >
                    </DialogHeader>

                    <div class="max-h-[60vh] space-y-4 overflow-y-auto">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                name="name"
                                v-model="form.name"
                                ref="nameInput"
                                placeholder="Name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>
                    </div>

                    <DialogFooter class="gap-2">
                        <DialogClose as-child>
                            <Button
                                variant="secondary"
                                @click="
                                    () => {
                                        form.clearErrors();
                                        form.reset();
                                    }
                                "
                            >
                                Cancel
                            </Button>
                        </DialogClose>

                        <Button type="submit" :disabled="form.processing">
                            Update
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
</template>
