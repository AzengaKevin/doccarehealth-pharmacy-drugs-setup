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
import { update as updateManufacturer } from '@/routes/manufacturers';
import type Manufacturer from '@/types/manufacturer';
import { useForm } from '@inertiajs/vue3';

type EditManufacturerSectionProps = {
    manufacturer?: Manufacturer;
};

const props = defineProps<EditManufacturerSectionProps>();

const open = defineModel<boolean>('open');

const form = useForm({
    name: props.manufacturer?.name || '',
    country: props.manufacturer?.country || '',
    contact_info: props.manufacturer?.contact_info || '',
});

const submit = () => {
    const manufacturerId = props.manufacturer?.id;

    if (manufacturerId) {
        form.put(updateManufacturer(manufacturerId).url, {
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
                        <DialogTitle>Edit Manufacturer</DialogTitle>
                        <DialogDescription
                            >Update the details of the
                            manufacturer</DialogDescription
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
                        <div class="grid gap-2">
                            <Label for="country">Country</Label>
                            <Input
                                id="country"
                                type="text"
                                name="country"
                                v-model="form.country"
                                placeholder="Country"
                            />
                            <InputError :message="form.errors.country" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="contact_info"
                                >Contact Information</Label
                            >
                            <Input
                                id="contact_info"
                                type="text"
                                name="contact_info"
                                v-model="form.contact_info"
                                placeholder="Contact Information"
                            />
                            <InputError :message="form.errors.contact_info" />
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
