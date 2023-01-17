<template>
    <div class="h-screen flex w-full bg-light overflow-hidden">
        <!--  Sidebar  -->
        <Sidebar />
        <div class="overflow-y-scroll grow flex flex-col bg-blue w-full">
            <Header @toggleSidebar="toggleSidebar" :isSearchOpen="searchDialogOpen" />
            <main class="grow px-4 py-3 bg-light">
                <slot />
            </main>
        </div>
    </div>
</template>
<script setup>
import { useEventListener } from '@vueuse/core'
import { ref } from "vue";

const sidebar = ref(null);
const searchDialogOpen = ref(false);

function toggleSidebar() {
    if (sidebar.classList.contains('flex')) {
        sidebar.classList.remove('flex');
        sidebar.classList.add('fixed');
    } else {
        sidebar.classList.add('flex');
        sidebar.classList.remove('fixed');
    }
}


useEventListener('keydown', (e) => {
    if (e.ctrlKey && e.key === 'k') {
        e.preventDefault();
        searchDialogOpen.value = !searchDialogOpen.value;
    }
})
</script>
