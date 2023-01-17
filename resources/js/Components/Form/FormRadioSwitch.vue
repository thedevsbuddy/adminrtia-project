<template>
    <label class="relative inline-flex items-center cursor-pointer">
        <input v-bind="$attrs" type="checkbox" value="" class="sr-only peer" @change="e => emit('change', e)">
        <div
            class="w-11 h-5 bg-gray-300 relative peer-focus:outline-none peer-focus:ring-none  rounded-full peer peer:after:left-0 peer-checked:after:left-auto peer-checked:after:right-0.5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all  peer-checked:bg-accent">
        </div>
        <!-- <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span> -->
    </label>
</template>


<script setup>

// const props = defineProps({
//     modelValue: [String, Number, Boolean],
// })

const emit = defineEmits(['change'])
</script>

