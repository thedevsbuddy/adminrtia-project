<template>
    <div class="flex flex-col items-center justify-center">
        <div v-bind="$attrs"
            class="group flex items-center justify-center w-24 h-24 rounded-full overflow-hidden relative">
            <input type="file" :model-value="props.modelValue" accept="image/*" class="hidden" ref="file"
                @input="onFileSelect" />
            <img :src="src" alt="" :class="`h-full w-full object-cover ${props.imageClass}`">
            <div class="hidden group-hover:block absolute inset-0 bg-black/50"></div>
            <button type="button" @click="selectFile"
                class="hidden group-hover:flex items-center justify-center absolute rounded-full p-4 bg-slate-900/60 z-[2]">
                <UserIcon class="w-5 h-5 text-light" />
            </button>
        </div>
        <label v-if="props.label" class="flex mt-2 text-sm font-medium text-slate-500 items-center space-x-1">
            <span>{{ props.label }}</span>
            <span v-if="props.required" class="font-bold text-red-500">*</span>
            <span v-if="props.isOptional" class="font-bold text-xs">(Optional)</span>
        </label>
    </div>
</template>

<script setup>
/// Imports
import { ref } from 'vue';
import { UserIcon } from '@heroicons/vue/24/outline';

/// Defaults Defines
const props = defineProps({
    modelValue: Object,
    default: String,
    label: String,
    required: Boolean,
    isOptional: Boolean,
    imageClass: String,
})
const emit = defineEmits(['update:modelValue'])

/// Variables
const file = ref(null);
const src = ref(props.default);


/// Methods
const selectFile = () => file.value.click();

const onFileSelect = e => {
    emit('update:modelValue', e.target.files[0]);

    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = (e) => {
        src.value = e.target.result;
    }
}

/// Lifecycle Hooks

</script>
