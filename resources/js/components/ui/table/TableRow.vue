<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = withDefaults(
  defineProps<{
    clickable?: boolean
    selected?: boolean
    disabled?: boolean
    hoverable?: boolean
    class?: HTMLAttributes["class"]
  }>(),
  {
    clickable: false,
    selected: false,
    disabled: false,
    hoverable: true,
  }
)

const emit = defineEmits<{
  click: [event: MouseEvent]
}>()

function handleClick(event: MouseEvent) {
  if (!props.disabled) {
    emit('click', event)
  }
}
</script>

<template>
  <tr
    data-slot="table-row"
    :class="
      cn(
        'bg-white dark:bg-gray-900 transition-colors',
        {
          // States
          'cursor-pointer': clickable && !disabled,
          'hover:bg-gray-50 dark:hover:bg-gray-800': hoverable && !disabled,
          'bg-primary-50 dark:bg-primary-900/20': selected,
          'opacity-50 cursor-not-allowed': disabled,
        },
        props.class
      )
    "
    :aria-selected="selected || undefined"
    :aria-disabled="disabled || undefined"
    @click="handleClick"
  >
    <slot />
  </tr>
</template>