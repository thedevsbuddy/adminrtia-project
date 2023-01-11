<template>
  <button :class="`flex items-center px-4 py-1 h-8 rounded-lg space-x-1 bg-slate-700 text-white text-sm font-medium hover:primary/90 ${props.class}`">
    <slot />
  </button>
</template>
<script setup>

import  {defineProps} from "vue";

const props = defineProps({
  class: String
})
</script>
