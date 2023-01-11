<template>
  <button class="w-full text-left px-4 py-2 hover:bg-slate-100">
    <slot />
  </button>
</template>
<script setup>
import { defineProps } from "vue";

const props = defineProps({
  label: {
    type: String,
    default: "Dropdown button"
  }
})
</script>
