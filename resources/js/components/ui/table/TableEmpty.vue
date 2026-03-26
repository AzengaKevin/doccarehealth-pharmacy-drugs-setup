<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    title?: string
    description?: string
    icon?: any
    class?: HTMLAttributes["class"]
  }>(),
  {
    title: "No data",
    description: "No records to display",
  }
)
</script>

<template>
  <div
    data-slot="table-empty"
    :class="
      cn(
        'flex flex-col items-center justify-center py-12 px-4',
        props.class
      )
    "
  >
    <div
      v-if="icon || $slots.icon"
      class="mb-4 text-gray-400 dark:text-gray-500"
    >
      <slot name="icon">
        <component :is="icon" class="h-12 w-12" />
      </slot>
    </div>
    
    <h3
      v-if="title || $slots.title"
      class="mb-2 text-lg font-semibold text-gray-900 dark:text-gray-100"
    >
      <slot name="title">
        {{ title }}
      </slot>
    </h3>
    
    <p
      v-if="description || $slots.description"
      class="text-center text-gray-500 dark:text-gray-400"
    >
      <slot name="description">
        {{ description }}
      </slot>
    </p>
    
    <div v-if="$slots.actions" class="mt-4">
      <slot name="actions" />
    </div>
  </div>
</template>