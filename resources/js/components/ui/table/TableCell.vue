<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    align?: "left" | "center" | "right"
    colspan?: number
    rowspan?: number
    class?: HTMLAttributes["class"]
  }>(),
  {
    align: "left",
  }
)
</script>

<template>
  <td
    data-slot="table-cell"
    :colspan="colspan"
    :rowspan="rowspan"
    :class="
      cn(
        'px-6 py-4 whitespace-nowrap',
        'text-gray-700 dark:text-gray-300',
        {
          'text-left': align === 'left',
          'text-center': align === 'center',
          'text-right': align === 'right',
        },
        props.class
      )
    "
  >
    <slot />
  </td>
</template>