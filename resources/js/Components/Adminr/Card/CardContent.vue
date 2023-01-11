<template>
  <div :class="`bg-white px-3 py-2 rounded-b ${props.class}`">
    <slot />
  </div>
</template>
<script setup>
  import { defineProps } from "vue";

  const props = defineProps({
    class: String,
  })
</script>
