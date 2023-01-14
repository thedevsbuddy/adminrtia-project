<template>
  <div class="py-3 flex items-center justify-between">
    <h3 class="heading2">{{ props.title}}</h3>
    <slot />
  </div>
</template>
<script setup>
const props = defineProps({
  title: String,
})
</script>
