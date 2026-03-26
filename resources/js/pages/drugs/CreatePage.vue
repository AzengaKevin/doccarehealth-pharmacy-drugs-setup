<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { type Auth } from '@/types/auth';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    index as drugsIndex,
    create as drugsCreate,
    store as drugsStore,
} from '@/routes/drugs';
import {
    ChevronsUpDown,
    EllipsisVertical,
    FilterX,
    Pencil,
    Search,
    Trash2,
} from 'lucide-vue-next';
import type DosageForm from '@/types/dosage-form';
import type Manufacturer from '@/types/manufacturer';

type DrugsIndexPageProps = {
    auth: Auth;
    forms: Array<DosageForm>;
    manufacturers: Array<Manufacturer>;
};

const props = defineProps<DrugsIndexPageProps>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Drugs',
        href: drugsIndex().url,
    },
    {
        title: 'Create',
        href: drugsCreate().url,
    },
];

const form = useForm({
    generic_name: '',
    brand_name: '',
    description: '',
    therapeutic_class: '',
    pharmacological_class: '',
    atc_code: '',
    dosage_form: '',
    strength: '',
    route_of_administration: '',
    manufacturer: '',
    is_prescription_required: '',
    is_controller_substance: '',
    barcode: '',
    sku: '',
    unit_of_meausure: '',
    pack_size: '',
    side_effects: '',
    contraindications: '',
    drug_interactions: '',
    status: '',
});

const submit = () => {
    form.post(drugsStore().url);
};
</script>

<template>
    <Head>
        <title>Drugs</title>
    </Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="submit" class="space-y-4 p-4">
            <div class="grid gap-2">
                <Label for="generic-name">Generic Name</Label>
                <Input
                    id="generic-name"
                    v-model="form.generic_name"
                    type="text"
                />
                <InputError :message="form.errors.generic_name" />
            </div>
            <div class="grid gap-2">
                <Label for="brand-name">Brand Name</Label>
                <Input id="brand-name" v-model="form.brand_name" type="text" />
                <InputError :message="form.errors.brand_name" />
            </div>
            <div class="grid gap-2">
                <Label for="description">Description</Label>
                <Input
                    id="description"
                    v-model="form.description"
                    type="text"
                />
                <InputError :message="form.errors.description" />
            </div>
            <div class="grid gap-2">
                <Label for="therapeutic-class">Therapetic Class</Label>
                <Input
                    id="therapeutic-class"
                    v-model="form.therapeutic_class"
                    type="text"
                />
                <InputError :message="form.errors.therapeutic_class" />
            </div>
            <div class="grid gap-2">
                <Label for="pharmacological-class">Pharmacological Class</Label>
                <Input
                    id="pharmacological-class"
                    v-model="form.pharmacological_class"
                    type="text"
                />
                <InputError :message="form.errors.pharmacological_class" />
            </div>
            <div class="grid gap-2">
                <Label for="atc-code">ATC Code</Label>
                <Input id="atc-code" v-model="form.atc_code" type="text" />
                <InputError :message="form.errors.atc_code" />
            </div>
            <div class="grid gap-2">
                <Label for="dosage-form">Dosage Form</Label>
                <Input
                    id="dosage-form"
                    v-model="form.dosage_form"
                    type="text"
                />
                <InputError :message="form.errors.dosage_form" />
            </div>
            <div class="grid gap-2">
                <Label for="strength">Strength</Label>
                <Input id="strength" v-model="form.strength" type="text" />
                <InputError :message="form.errors.strength" />
            </div>
            <div class="grid gap-2">
                <Label for="route-of-administration"
                    >Route of Administration</Label
                >
                <Input
                    id="route-of-administration"
                    v-model="form.route_of_administration"
                    type="text"
                />
                <InputError :message="form.errors.dosage_form" />
            </div>
            <div class="grid gap-2">
                <Label for="manufacturer">Manufacturer</Label>
                <Input
                    id="manufacturer"
                    v-model="form.manufacturer"
                    type="text"
                />
                <InputError :message="form.errors.manufacturer" />
            </div>
            <div class="grid gap-2">
                <Label for="barcode">Barcode</Label>
                <Input id="barcode" v-model="form.barcode" type="text" />
                <InputError :message="form.errors.barcode" />
            </div>
            <div class="grid gap-2">
                <Label for="sku">SKU</Label>
                <Input id="sku" v-model="form.sku" type="text" />
                <InputError :message="form.errors.sku" />
            </div>
            <div class="grid gap-2">
                <Label for="unit-of-measure">Unit of Measure</Label>
                <Input
                    id="unit-of-measure"
                    v-model="form.unit_of_meausure"
                    type="text"
                />
                <InputError :message="form.errors.unit_of_meausure" />
            </div>
            <div class="grid gap-2">
                <Label for="pack-size">Pack Size</Label>
                <Input id="pack-size" v-model="form.pack_size" type="text" />
                <InputError :message="form.errors.pack_size" />
            </div>
            <div class="grid gap-2">
                <Label for="side-effects">Side Effects</Label>
                <Input
                    id="side-effects"
                    v-model="form.side_effects"
                    type="text"
                />
                <InputError :message="form.errors.side_effects" />
            </div>
            <div class="grid gap-2">
                <Label for="contraindications">Contraindications</Label>
                <Input
                    id="contraindications"
                    v-model="form.contraindications"
                    type="text"
                />
                <InputError :message="form.errors.contraindications" />
            </div>
            <div class="grid gap-2">
                <Label for="drug-interactions">Drug Interations</Label>
                <Input
                    id="drug-interactions"
                    v-model="form.drug_interactions"
                    type="text"
                />
                <InputError :message="form.errors.drug_interactions" />
            </div>
            <div class="grid gap-2">
                <Label for="status">Status</Label>
                <Input id="status" v-model="form.status" type="text" />
                <InputError :message="form.errors.status" />
            </div>
            <div>
                <Button type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Creating...' : 'Create Drug' }}
                </Button>
            </div>
        </form>
    </AppLayout>
</template>
