<template>
  <div class="inline-flex items-center rounded-lg border divide-x">
    <pagination-item v-for="uri in props.links" :href="uri.url" :disabled="uri.url == null"  :active="uri.active" :key="uri.label" v-html="uri.label" />
  </div>
</template>
<script setup>
const props = defineProps({
  links: Array,
})
</script>
