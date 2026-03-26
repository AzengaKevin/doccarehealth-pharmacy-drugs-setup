<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    striped?: boolean
    dense?: boolean
    bordered?: boolean
    class?: HTMLAttributes["class"]
  }>(),
  {
    striped: true,
    dense: false,
    bordered: true,
  }
)
</script>

<template>
  <div
    data-slot="table-root"
    :class="
      cn(
        'relative overflow-x-auto',
        {
          'rounded-lg border border-gray-200 dark:border-gray-700': bordered,
          'shadow-xs': bordered,
        },
        props.class
      )
    "
  >
    <table
      :class="[
        'min-w-full divide-y divide-gray-200 dark:divide-gray-700',
        dense ? 'text-sm' : 'text-base',
      ]"
    >
      <slot />
    </table>
    
    <slot name="empty" />
  </div>
</template>