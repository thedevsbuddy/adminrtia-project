<template>
    <Link v-if="props.type != 'label'" v-bind="$attrs"
        class="w-full block text-left text-slate-600 px-4 py-2 text-sm hover:bg-slate-100 whitespace-nowrap">
    <slot />
    </Link>
    <span v-else v-bind="$attrs"
        class="w-full block text-left bg-slate-200 text-slate-700 px-4 py-2 text-xs font-semibold tracking-wider whitespace-nowrap">
        <slot />
    </span>
</template>
<script setup>
const props = defineProps({
    type: String,
})
</script>
