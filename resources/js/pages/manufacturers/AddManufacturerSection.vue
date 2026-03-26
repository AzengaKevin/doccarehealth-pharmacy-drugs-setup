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
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { store as manufacturersStore } from '@/routes/manufacturers';
import { useForm } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { ref } from 'vue';

const open = ref(false);

const form = useForm({
    name: '',
    country: '',
    contact_info: '',
});

const submit = () => {
    form.post(manufacturersStore().url, {
        onSuccess: () => {
            form.reset();
            open.value = false;
        },
        preserveScroll: true,
        preserveState: true,
    });
};
</script>

<template>
    <div>
        <Dialog v-model:open="open">
            <DialogTrigger as-child>
                <Button data-test="add-manufacturer-button">
                    <Plus class="h-4 w-4" /> New Manufacturer
                </Button>
            </DialogTrigger>
            <DialogContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <DialogHeader class="space-y-3">
                        <DialogTitle>Add a New Manufacturer</DialogTitle>
                        <DialogDescription
                            >Create a new manufacturer that is
                            missing</DialogDescription
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

                        <Button
                            type="submit"
                            :disabled="form.processing"
                            data-test="confirm-add-manufacturer-button"
                        >
                            Add Manufacturer
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
</template>
