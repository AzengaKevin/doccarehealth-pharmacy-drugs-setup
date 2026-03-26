<!-- Table/TableFooter.vue -->
<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    sticky?: boolean
    class?: HTMLAttributes["class"]
  }>(),
  {
    sticky: false,
  }
)
</script>

<template>
  <tfoot
    data-slot="table-footer"
    :class="
      cn(
        'bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700',
        {
          'sticky bottom-0 z-10': sticky,
        },
        props.class
      )
    "
  >
    <slot />
  </tfoot>
</template>