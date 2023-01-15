<template>
    <button @click="toggleDropdown" class="relative">
        <icon v-if="props.icon" :name="props.icon" />
        <span v-else class="block">{{ props.label }}</span>
        <Transition duration="500ms" enter-from-class="opacity-0 translate-y-4" enter-to-class="opacity-1 translate-y-0"
            leave-from-class="opacity-1 translate-y-0" leave-to-class="opacity-0 translate-y-4">
            <div v-if="isOpen" class="absolute block top-9 right-0 min-w-[12rem] bg-white rounded shadow-lg z-50">
                <dropdown-item v-for="option in options" :key="option.label" :href="option.url" :type="option.type">{{
                    option.label
                }}</dropdown-item>
            </div>
        </Transition>
    </button>

</template>
<script setup>
import { onMounted, ref } from "vue";

const isOpen = ref(false);

const props = defineProps({
    label: {
        type: String,
    },
    icon: String,
    options: Object,
    opened: {
        type: Boolean,
        default: false
    }
})

onMounted(() => {
    isOpen.value = props.opened;
})

const toggleDropdown = function () {
    isOpen.value = !isOpen.value;
}
</script>
