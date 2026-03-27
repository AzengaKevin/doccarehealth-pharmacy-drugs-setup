<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Select } from '@/components/ui/select';
import {
    TableBody,
    TableCell,
    TableColumnHeaderCell,
    TableHeader,
    TableRoot,
    TableRow,
} from '@/components/ui/table';
import useDrugs from '@/composables/useDrugs';
import useDates from '@/composables/useDates';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import {
    edit as drugsEdit,
    index as drugsIndex,
    show as drugsShow,
} from '@/routes/drugs';
import { type BreadcrumbItem } from '@/types';
import { type Auth } from '@/types/auth';
import type Drug from '@/types/drug';
import { Head, Link } from '@inertiajs/vue3';
import { Pencil, Trash2 } from 'lucide-vue-next';

type DrugsShowPageProps = {
    drug: Drug;
    auth: Auth;
};

const props = defineProps<DrugsShowPageProps>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Backoffice',
        href: dashboard().url,
    },
    {
        title: 'Drugs',
        href: drugsIndex().url,
    },
    {
        title: `# ${props.drug.id}`,
        href: drugsShow(props.drug.id).url,
    },
];

const { formatDateTime } = useDates();

const { deleteDrug } = useDrugs();
</script>

<template>
    <Head>
        <title>Drug Details</title>
    </Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <TableRoot>
            <TableHeader>
                <TableRow>
                    <TableColumnHeaderCell :colspan="3">
                        <div class="flex justify-end gap-3">
                            <Link
                                :as="Button"
                                :href="drugsEdit(props.drug.id).url"
                            >
                                <Pencil class="size-3" />
                                Edit
                            </Link>

                            <Button
                                variant="destructive"
                                @click="deleteDrug(props.drug)"
                            >
                                <Trash2 class="size-3" />
                                Delete
                            </Button>
                        </div>
                    </TableColumnHeaderCell>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow>
                    <TableColumnHeaderCell> Id </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.id }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Generic Name
                    </TableColumnHeaderCell>
                    <TableColumnHeaderCell>
                        {{ props.drug.generic_name }}
                    </TableColumnHeaderCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Brand Name </TableColumnHeaderCell>
                    <TableColumnHeaderCell>
                        {{ props.drug.brand_name }}
                    </TableColumnHeaderCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Description </TableColumnHeaderCell>
                    <TableColumnHeaderCell>
                        {{ props.drug.description }}
                    </TableColumnHeaderCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Therapeutic Class
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.therapeutic_class }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Pharmacological Class
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.pharmacological_class }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> ATC Code </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.atc_code }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Dosage Form </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.dosage_form_id ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Strength </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.strength ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Manufacturer
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.manufacturer_id ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Is Prescription Required
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.is_prescription_required ? 'Yes' : 'No' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Is Controlled Substance
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.is_controlled_substance ? 'Yes' : 'No' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Barcode </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.barcode ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> SKU </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.sku ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Unit of Measure
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.unit_of_measure ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Pack Size </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.pack_size ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Side Effects
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.side_effects ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Contraindications
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.contraindications ?? '-' }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell>
                        Drug Interactions
                    </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.drug_interactions ?? '-' }}
                    </TableCell>
                    <TableCell> </TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Status </TableColumnHeaderCell>
                    <TableCell>
                        {{ props.drug.status ?? '-' }}
                    </TableCell>
                    <TableCell> </TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Created At </TableColumnHeaderCell>
                    <TableCell>
                        {{ formatDateTime(props.drug.created_at) }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
                <TableRow>
                    <TableColumnHeaderCell> Updated At </TableColumnHeaderCell>
                    <TableCell>
                        {{ formatDateTime(props.drug.updated_at) }}
                    </TableCell>
                    <TableCell></TableCell>
                </TableRow>
            </TableBody>
        </TableRoot>
    </AppLayout>
</template>
