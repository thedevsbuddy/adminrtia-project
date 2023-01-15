<template>
    <div class="shrink-0 h-12 bg-slate-800 text-light border-b sticky top-0 z-50">
        <nav class="px-4 py-2 flex items-center justify-between h-full">
            <ul class="flex h-full items-center space-x-2 ">
                <li>
                    <button class="block" @click="$emit('toggleSidebar')">
                        <icon name="menu" class="w-6 h-6" />
                    </button>
                </li>
            </ul>
            <div class="flex items-center space-x-4">
                <div
                    class="group bg-slate-900 hover:bg-slate-700 ease-in-out transition-colors duration-300  cursor-pointer rounded-lg w-56 h-8 flex items-center justify-between px-2 py-1">
                    <div class="flex items-center">
                        <icon name="search" />
                        <span class="text-sm pl-1">Search here...</span>
                    </div>
                    <span
                        class="bg-slate-700 ease-in-out transition-colors duration-300 group-hover:bg-slate-900  rounded-lg px-2 -mr-1 text-xs tracking-wider uppercase h-full flex items-center">Ctrl+k</span>
                </div>
                <XButton as="link" class="!bg-primary hover:!bg-primary/80" label="Builder" icon="diamond" cicon />

                <Link href="#" class="flex px-2 items-center text-sm space-x-2">
                <icon name="apps" cicon class="w-4 h-4" />
                <span>Generated resources</span>
                </Link>
                <dropdown :options="dropdownOptions" icon="setting">
                    <!-- <template #dropdownOptions>
                        <Link href="/" v-for="(option, i) in dropdownOptions" :key="i">
                        <dropdown-item class="text-gray-700">{{ option.label }}</dropdown-item>
                        </Link>
                    </template> -->
                </dropdown>
                <Link as="button" href="#" class="w-8 h-8 rounded-full overflow-hidden block">
                <img :src="asset('images/user-placeholder.jpg')"
                    class="h-full w-full rounded-full object-cover m-0 block" alt="" />
                </Link>
            </div>

        </nav>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";

defineEmits(['toggleSidebar']);

const isSearchOpened = ref(false);
const props = defineProps({
    isSearchOpen: Boolean,
})

onMounted(() => {
    isSearchOpened.value = props.isSearchOpen;
})

const dropdownOptions = [
    {
        label: "Configurations",
        type: "label"
    },
    {
        label: "Email templates",
        type: "link",
        url: route('adminr.templates.index'),
    },
    {
        label: "General",
        type: "link",
        url: route('adminr.settings.general'),
    },
    {
        label: "Email",
        type: "link"
    },
    {
        label: "Features",
        type: "link"
    },
];
</script>
