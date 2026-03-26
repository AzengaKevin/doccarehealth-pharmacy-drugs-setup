<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <tbody
    data-slot="table-body"
    :class="cn('divide-y divide-gray-200 dark:divide-gray-700', props.class)"
  >
    <slot />
  </tbody>
</template>