<template>
    <div v-bind="$attrs"
        class="absolute inset-0 z-[2] bg-white/60 text-slate-600 flex flex-col items-center justify-center">
        <img :src="asset('images/loading.gif')" alt="" />
        <p>{{ props.message }}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    message: String,
});
</script>
