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
import { store as dosageFormsStore } from '@/routes/dosage-forms';
import { useForm } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { ref } from 'vue';

const open = ref(false);

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(dosageFormsStore().url, {
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
                <Button data-test="add-dosage-form-button"
                    ><Plus class="h-4 w-4" /> New Dosage Form</Button
                >
            </DialogTrigger>
            <DialogContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <DialogHeader class="space-y-3">
                        <DialogTitle>Add a New Dosage Form</DialogTitle>
                        <DialogDescription
                            >Create a new dosage form that is
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
                            data-test="confirm-add-dosage-form-button"
                        >
                            Add Dosage Form
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
</template>
