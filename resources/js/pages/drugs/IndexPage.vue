<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Pagination } from '@/components/ui/pagination';
import {
    TableBody,
    TableCell,
    TableColumnHeaderCell,
    TableHeader,
    TableRoot,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { type Auth } from '@/types/auth';
import Drug from '@/types/drug';
import type { LaravelPaginator } from '@/types/pagination';
import { Head, Link, router } from '@inertiajs/vue3';
import {
    index as drugsIndex,
    show as drugsShow,
    edit as drugsEdit,
    create as drugsCreate,
    exportDrugs as drugsExport,
} from '@/routes/drugs';
import debounce from 'lodash/debounce';
import useDates from '@/composables/useDates';
import {
    ChevronsUpDown,
    Download,
    EllipsisVertical,
    Eye,
    FilterX,
    Pencil,
    Plus,
    Search,
    Trash2,
} from 'lucide-vue-next';
import { reactive, ref, watch } from 'vue';
import useDrugs from '@/composables/useDrugs';
import ImportDrugsSection from '@/pages/drugs/ImportDrugsSection.vue';

type DrugsIndexPageProps = {
    auth: Auth;
    drugs: LaravelPaginator<Drug>;
    params: Record<string, any>;
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
];

const { formatDateTime } = useDates();

const { deleteDrug } = useDrugs();

const page = ref(props.drugs.current_page);

const filters = reactive({
    ...props.params,
});

watch(page, (newPage) => {
    router.get(
        drugsIndex().url,
        { ...filters, page: newPage },
        {
            preserveState: true,
            replace: true,
        },
    );
});

watch(
    filters,
    debounce((newFilters) => {
        router.get(
            drugsIndex().url,
            { ...newFilters },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 300),
    { deep: true },
);
</script>

<template>
    <Head>
        <title>Drugs</title>
    </Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-hidden">
            <div
                class="flex flex-col justify-between border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center"
            >
                <div class="mb-4 sm:mb-0">
                    <p class="mt-1 text-sm">
                        Showing
                        <span class="font-medium">{{ drugs.from }}</span>
                        to
                        <span class="font-medium">{{ drugs.to }}</span>
                        drugs
                    </p>
                </div>

                <div class="flex flex-wrap gap-2 sm:flex-row sm:gap-3">
                    <div class="relative w-full sm:w-auto">
                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <Search class="h-4 w-4 text-gray-400" />
                        </div>
                        <input
                            type="search"
                            v-model="filters.query"
                            class="focus:ring-primary-500 focus:border-primary-500 w-full rounded-lg border border-gray-300 py-2 pr-4 pl-10 transition-all outline-none focus:ring-2"
                            placeholder="Search drugs..."
                        />
                    </div>

                    <Button
                        :as="Link"
                        :href="drugsIndex().url"
                        variant="outline"
                    >
                        <FilterX class="h-4 w-4" />
                        Filters
                    </Button>
                    <Button :as="Link" :href="drugsCreate().url">
                        <Plus class="h-4 w-4" />
                        Add New Drug
                    </Button>

                    <ImportDrugsSection />

                    <Button
                        as="a"
                        class="w-fit"
                        :href="drugsExport({ query: { ...filters } }).url"
                    >
                        <Download class="h-4 w-4" /> Export Drugs
                    </Button>
                </div>
            </div>

            <div class="p-6">
                <TableRoot>
                    <TableHeader>
                        <TableRow>
                            <TableColumnHeaderCell scope="col">
                                <span>#</span>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Generic Name</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Brand Name</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>ATC Code</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>SKU</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Strength</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Administration</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Created At</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                Actions
                            </TableColumnHeaderCell>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="drugs.data.length">
                            <TableRow v-for="(drug, index) in drugs.data">
                                <TableCell>
                                    {{ (drugs.from ?? 0) + index }}
                                </TableCell>

                                <TableCell>{{ drug.generic_name }}</TableCell>
                                <TableCell>{{ drug.brand_name }}</TableCell>
                                <TableCell>{{
                                    drug.atc_code ?? '-'
                                }}</TableCell>
                                <TableCell>{{ drug.sku ?? '-' }}</TableCell>
                                <TableCell>{{
                                    drug.strength ?? '-'
                                }}</TableCell>
                                <TableCell>{{
                                    drug.route_of_administration ?? '-'
                                }}</TableCell>
                                <TableCell>
                                    {{ formatDateTime(drug.created_at) }}
                                </TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger :as-child="true">
                                            <Button variant="ghost" size="icon">
                                                <EllipsisVertical
                                                    class="h-5 w-5"
                                                />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent
                                            align="end"
                                            class="w-56"
                                        >
                                            <DropdownMenuItem
                                                value="Show"
                                                class="group text-grass11 data-disabled:text-mauve8 data-highlighted:bg-green9 data-highlighted:text-green1 relative flex items-center rounded-[3px] p-2 leading-none outline-none select-none data-disabled:pointer-events-none"
                                                @select="
                                                    router.visit(
                                                        drugsShow(drug.id).url,
                                                    )
                                                "
                                            >
                                                <Eye class="h-3 w-3" />
                                                Show
                                            </DropdownMenuItem>
                                            <DropdownMenuItem
                                                value="Edit"
                                                class="group text-grass11 data-disabled:text-mauve8 data-highlighted:bg-green9 data-highlighted:text-green1 relative flex items-center rounded-[3px] p-2 leading-none outline-none select-none data-disabled:pointer-events-none"
                                                @select="
                                                    router.visit(
                                                        drugsEdit(drug.id).url,
                                                    )
                                                "
                                            >
                                                <Pencil class="h-3 w-3" />
                                                Edit
                                            </DropdownMenuItem>
                                            <DropdownMenuItem
                                                value="Delete"
                                                class="group text-grass11 data-disabled:text-mauve8 data-highlighted:bg-green9 data-highlighted:text-green1 relative flex items-center rounded-[3px] p-2 leading-none outline-none select-none data-disabled:pointer-events-none"
                                                @select="deleteDrug(drug)"
                                            >
                                                <Trash2 class="h-3 w-3" />
                                                Delete
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>
                        </template>

                        <TableRow v-else>
                            <TableCell
                                :colspan="9"
                                class="px-6 py-4 whitespace-nowrap"
                            >
                                <div class="text-sm font-medium">
                                    No drugs found.
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </TableRoot>
            </div>

            <div
                class="flex flex-col items-center justify-between border-t border-gray-200 px-6 py-4 sm:flex-row"
            >
                <div class="mb-4 text-sm text-gray-700 sm:mb-0">
                    Showing
                    <span class="font-medium">{{ drugs.from }}</span> to
                    <span class="font-medium">{{ drugs.to }}</span> of
                    <span class="font-medium">{{ drugs.total }}</span>
                    entries
                </div>

                <Pagination
                    :total="drugs.total"
                    :items-per-page="drugs.per_page"
                    :default-page="drugs.current_page"
                    :show-edges="true"
                    :sibling-count="3"
                    v-model:page="page"
                />
            </div>
        </div>
    </AppLayout>
</template>
