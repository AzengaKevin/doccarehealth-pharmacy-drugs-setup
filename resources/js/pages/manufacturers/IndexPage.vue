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
import AddManufacturerSetion from '@/pages/manufacturers/AddManufacturerSection.vue';
import EditManufacturerSection from '@/pages/manufacturers/EditManufacturerSection.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { type Auth } from '@/types/auth';
import type Manufacturer from '@/types/manufacturer';
import type { LaravelPaginator } from '@/types/pagination';
import { Head, Link, router } from '@inertiajs/vue3';
import { index as manufacturersIndex } from '@/routes/manufacturers';
import debounce from 'lodash/debounce';
import useDates from '@/composables/useDates';
import {
    ChevronsUpDown,
    EllipsisVertical,
    FilterX,
    Pencil,
    Search,
    Trash2,
} from 'lucide-vue-next';
import { reactive, ref, watch } from 'vue';
import useManufacturers from '@/composables/useManufacturers';

type ManufacturersIndexPageProps = {
    auth: Auth;
    manufacturers: LaravelPaginator<Manufacturer>;
    params: Record<string, any>;
};

const props = defineProps<ManufacturersIndexPageProps>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Manufacturers',
        href: manufacturersIndex().url,
    },
];

const selectedManufacturer = ref<Manufacturer | null>(null);

const editManufacturerDialogOpen = ref(false);

const showEditManufacturerDialog = (manufacturer: Manufacturer) => {
    selectedManufacturer.value = manufacturer;
    editManufacturerDialogOpen.value = true;
};

const { formatDateTime } = useDates();

const { deleteManufacturer } = useManufacturers();

const page = ref(props.manufacturers.current_page);

const filters = reactive({
    ...props.params,
});

watch(page, (newPage) => {
    router.get(
        manufacturersIndex().url,
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
            manufacturersIndex().url,
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
        <title>Manufacturers</title>
    </Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-hidden">
            <div
                class="flex flex-col justify-between border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center"
            >
                <div class="mb-4 sm:mb-0">
                    <p class="mt-1 text-sm">
                        Showing
                        <span class="font-medium">{{
                            manufacturers.from
                        }}</span>
                        to
                        <span class="font-medium">{{ manufacturers.to }}</span>
                        manufacturers
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
                            placeholder="Search Manufacturers..."
                        />
                    </div>

                    <Button
                        :as="Link"
                        :href="manufacturersIndex().url"
                        variant="outline"
                    >
                        <FilterX class="h-4 w-4" />
                        Filters
                    </Button>
                    <AddManufacturerSetion />
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
                                    <span>Name</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Country</span>
                                    <button class="ml-1">
                                        <ChevronsUpDown class="h-3 w-3" />
                                    </button>
                                </div>
                            </TableColumnHeaderCell>
                            <TableColumnHeaderCell scope="col">
                                <div class="flex items-center">
                                    <span>Contact Info</span>
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
                        <template v-if="manufacturers.data.length">
                            <TableRow
                                v-for="(
                                    manufacturer, index
                                ) in manufacturers.data"
                            >
                                <TableCell>
                                    {{ (manufacturers.from ?? 0) + index }}
                                </TableCell>

                                <TableCell>
                                    <div
                                        class="flex flex-col items-start gap-2"
                                    >
                                        <span>{{ manufacturer.name }}</span>
                                    </div>
                                </TableCell>

                                <TableCell>
                                    <div
                                        class="flex flex-col items-start gap-2"
                                    >
                                        <span>{{
                                            manufacturer.country ?? '-'
                                        }}</span>
                                    </div>
                                </TableCell>

                                <TableCell>
                                    <div
                                        class="flex flex-col items-start gap-2"
                                    >
                                        <span>{{
                                            manufacturer.contact_info ?? '-'
                                        }}</span>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    {{
                                        formatDateTime(manufacturer.created_at)
                                    }}
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
                                                value="Edit"
                                                class="group text-grass11 data-disabled:text-mauve8 data-highlighted:bg-green9 data-highlighted:text-green1 relative flex items-center rounded-[3px] p-2 leading-none outline-none select-none data-disabled:pointer-events-none"
                                                @select="
                                                    showEditManufacturerDialog(
                                                        manufacturer,
                                                    )
                                                "
                                            >
                                                <Pencil class="h-3 w-3" />
                                                Edit
                                            </DropdownMenuItem>
                                            <DropdownMenuItem
                                                value="Delete"
                                                class="group text-grass11 data-disabled:text-mauve8 data-highlighted:bg-green9 data-highlighted:text-green1 relative flex items-center rounded-[3px] p-2 leading-none outline-none select-none data-disabled:pointer-events-none"
                                                @select="
                                                    deleteManufacturer(
                                                        manufacturer,
                                                    )
                                                "
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
                                :colspan="5"
                                class="px-6 py-4 whitespace-nowrap"
                            >
                                <div class="text-sm font-medium">
                                    No Manufacturers found.
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
                    <span class="font-medium">{{ manufacturers.from }}</span> to
                    <span class="font-medium">{{ manufacturers.to }}</span> of
                    <span class="font-medium">{{ manufacturers.total }}</span>
                    entries
                </div>

                <Pagination
                    :total="manufacturers.total"
                    :items-per-page="manufacturers.per_page"
                    :default-page="manufacturers.current_page"
                    :show-edges="true"
                    :sibling-count="3"
                    v-model:page="page"
                />
            </div>
        </div>
    </AppLayout>

    <teleport to="body">
        <EditManufacturerSection
            v-if="selectedManufacturer"
            :manufacturer="selectedManufacturer"
            v-model:open="editManufacturerDialogOpen"
        />
    </teleport>
</template>
