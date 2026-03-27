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
import { useForm } from '@inertiajs/vue3';
import { Upload } from 'lucide-vue-next';
import { ref } from 'vue';
import { importDrugs } from '@/routes/drugs';

const open = ref(false);

type FormData = {
    file: File | null;
};

const form = useForm<FormData>({
    file: null,
});

const submit = () => {
    form.post(importDrugs().url, {
        onSuccess: () => {
            open.value = false;
            form.reset();
        },
    });
};
</script>

<template>
    <div>
        <Dialog v-model:open="open">
            <DialogTrigger as-child>
                <Button> <Upload class="h-4 w-4" /> Import Drugs </Button>
            </DialogTrigger>
            <DialogContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <DialogHeader class="space-y-3">
                        <DialogTitle>Import Drugs</DialogTitle>
                        <DialogDescription>
                            Upload a file to import drugs
                        </DialogDescription>
                    </DialogHeader>
                    <div class="grid w-full items-center gap-4">
                        <Label for="file">File</Label>
                        <Input
                            id="file"
                            type="file"
                            @change="
                                (e: Event) =>
                                    (form.file =
                                        (e.target as HTMLInputElement)
                                            .files?.[0] ?? null)
                            "
                            data-test="file-input"
                        />

                        <InputError :message="form.errors.file" class="mt-2" />
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
                            Import
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
</template>
