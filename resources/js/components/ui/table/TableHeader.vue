<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = defineProps<{
  sticky?: boolean
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <thead
    data-slot="table-header"
    :class="
      cn(
        'bg-gray-50 dark:bg-gray-800',
        {
          'sticky top-0 z-10': sticky,
        },
        props.class
      )
    "
  >
    <slot />
  </thead>
</template>