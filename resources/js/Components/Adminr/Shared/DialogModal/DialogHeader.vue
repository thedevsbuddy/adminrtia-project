<template>
    <div  v-bind="$attrs" class="border-b px-4 py-2 flex justify-between">
        <DialogTitle v-if="props.title" class="text-lg font-semibold text-slate-600">{{
            props.title
        }}
        </DialogTitle>
        <button type="button" class="outline-none text-slate-800 ring-none p-0 cursor-pointer p-1" @click="closeModal">
            <icon cicon name="plus" class="h-4 w-4 -rotate-45" />
        </button>
    </div>
</template>

<script setup>
import { DialogTitle } from '@headlessui/vue'
const emit = defineEmits(['close']);

const props = defineProps({
    title: String,
})

function closeModal(e) {
    emit('close', e);
}

</script>
