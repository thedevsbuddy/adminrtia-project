<template>
  <Link :class="`${props.active ? 'bg-primary border-primary text-white cursor-default' : props.disabled ? 'bg-slate-200 text-slate-600 pointer-events-none' : 'bg-white hover:bg-light text-slate-600'} text-sm font-semibold flex items-center justify-center px-4 py-2 first:rounded-l-lg last:rounded-r-lg ${props.disabled ? 'cursor-not-allowed' : ''}`" :disabled="props.disabled">
    <slot />
  </Link>
</template>
<script setup>
const props = defineProps({
  active: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
})
</script>
