<script setup lang="ts">
import { ChevronsLeft, ChevronLeft, ChevronsRight, ChevronRight } from 'lucide-vue-next';
import { PaginationEllipsis, PaginationFirst, PaginationLast, PaginationList, PaginationListItem, PaginationNext, PaginationPrev, PaginationRoot } from 'reka-ui'

type PaginationProps = {
  total: number;
  itemsPerPage: number;
  siblingCount?: number;
  showEdges?: boolean;
  defaultPage?: number;
  page: number;
}

defineProps<PaginationProps>();

const emit = defineEmits<{
  (e: 'update:page', value: number): void
}>()
</script>

<template>
  <PaginationRoot :total="total" :sibling-count="siblingCount" :items-per-page="itemsPerPage" :show-edges="showEdges"
    :default-page="defaultPage" :page="page" @update:page="emit('update:page', $event)">
    <PaginationList v-slot="{ items }" class="flex items-center gap-1 text-stone-700 dark:text-white">
      <PaginationFirst
        class="w-9 h-9  flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition disabled:opacity-50 rounded-lg">
        <ChevronsLeft />
      </PaginationFirst>
      <PaginationPrev
        class="w-9 h-9  flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition mr-4  disabled:opacity-50 rounded-lg">
        <ChevronLeft />
      </PaginationPrev>
      <template v-for="(page, index) in items">
        <PaginationListItem v-if="page.type === 'page'" :key="index"
          class="w-9 h-9 border dark:border-stone-800 rounded-lg data-[selected]:!bg-white data-[selected]:shadow-sm data-[selected]:text-blackA11 hover:bg-white dark:hover:bg-stone-700/70 transition"
          :value="page.value">
          {{ page.value }}
        </PaginationListItem>
        <PaginationEllipsis v-else :key="page.type" :index="index" class="w-9 h-9 flex items-center justify-center">
          &#8230;
        </PaginationEllipsis>
      </template>
      <PaginationNext
        class="w-9 h-9  flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition ml-4 disabled:opacity-50 rounded-lg">
        <ChevronRight />
      </PaginationNext>
      <PaginationLast
        class="w-9 h-9  flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition disabled:opacity-50 rounded-lg">
        <ChevronsRight />
      </PaginationLast>
    </PaginationList>
  </PaginationRoot>
</template>