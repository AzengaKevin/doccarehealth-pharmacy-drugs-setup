<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    align?: "left" | "center" | "right"
    width?: string
    class?: HTMLAttributes["class"]
  }>(),
  {
    align: "left",
  }
)
</script>

<template>
  <th
    data-slot="table-column-header"
    :class="
      cn(
        'px-6 py-3 text-left text-sm font-semibold',
        'text-gray-900 dark:text-gray-100',
        'whitespace-nowrap',
        {
          'text-left': align === 'left',
          'text-center': align === 'center',
          'text-right': align === 'right',
        },
        props.class
      )
    "
    :style="{ width }"
  >
    <slot />
  </th>
</template>