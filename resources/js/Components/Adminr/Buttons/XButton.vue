<template>
  <Link v-if="props.as === 'link'" v-bind="$attrs" :class="`flex items-center ${props.label ? 'px-4' : 'px-2'} py-1 h-8 rounded-lg space-x-1 bg-slate-700 text-white text-sm font-medium hover:primary/90 ${props.class}`">
    <component v-if="props.heroIcon != null" :is="props.heroIcon" class="w-4 h-4" />
    <icon v-else-if="props.icon != null" :name="props.icon" class="w-4 h-4" />
<!--    <icon v-if="props.icon != null" :name="props.icon" class="w-4 h-4" />-->
    <span v-if="props.label">{{ props.label }}</span>
  </Link>
  <button v-else v-bind="$attrs" :class="`flex items-center px-4 py-1 h-8 rounded-lg space-x-1 bg-slate-700 text-white text-sm font-medium hover:primary/90 ${props.class}`">
    <ArrowPathIcon v-if="props.isBusy" class="w-4 h-4" />
    <div v-else class="flex items-center space-x-1">
      <component v-if="props.heroIcon != null" :is="props.heroIcon" class="w-4 h-4" />
      <icon v-else-if="props.icon != null" :name="props.icon" class="w-4 h-4" />
      <span v-if="props.label">{{ props.label }}</span>
    </div>
  </button>
</template>
<script setup>

import {ArrowPathIcon} from '@heroicons/vue/24/outline'
import  {defineProps} from "vue";

const props = defineProps({
  class: String,
  label: String,
  as: {
    type: String,
    default: 'button',
    validator: value => {
      return ['link', 'button'].includes(value)
    }
  },
  icon: {
    type: String,
    default: null
  },
  heroIcon: {
    default: null
  },
  isBusy: Boolean,
})
</script>
