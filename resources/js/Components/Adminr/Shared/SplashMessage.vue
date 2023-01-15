<template>
    <div v-if="$page.props.splash.success"
        class="flex items-center justify-between rounded mb-3 px-4 py-1.5 text-sm font-semibold tracking-wider bg-green-100 text-green-600">
        <span>{{ $page.props.splash.success }}</span>
        <x-button :hero-icon="XMarkIcon" @click="$page.props.splash.success = null"
            class="px-2 bg-transparent text-green-600 py-1 -mr-2" />
    </div>
    <div v-if="$page.props.splash.error"
        class="flex items-center justify-between rounded mb-3 px-4 py-1.5 text-sm font-semibold tracking-wider bg-red-100 text-red-600">
        <span>{{ $page.props.splash.error }}</span>
        <x-button :hero-icon="XMarkIcon" @click="$page.props.splash.error = null"
            class="px-2 bg-transparent text-red-600 py-1 -mr-2" />
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { XMarkIcon } from "@heroicons/vue/24/outline"
import { useTimeout } from '@vueuse/core'
const props = defineProps({
    message: String,
});
</script>
