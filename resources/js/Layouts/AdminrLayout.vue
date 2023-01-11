<template>
  <div class="h-screen flex w-full bg-gray-200 overflow-hidden">
    <!--  Sidebar  -->
    <Sidebar/>
    <div class="overflow-y-scroll grow flex flex-col bg-blue w-full">
      <Header :isSearchOpen="searchDialogOpen.value" />
      <main class="grow px-4 py-3 bg-slate-100">
        <slot/>
      </main>
    </div>
  </div>
</template>
<script setup>
import Header from "@/Components/Adminr/Header";
import Sidebar from "@/Components/Adminr/Sidebar";
import {useEventListener} from '@vueuse/core'
import {ref} from "vue";

const searchDialogOpen = ref(false);

useEventListener('keydown', (e) => {
  if(e.ctrlKey && e.key === 'k'){
    e.preventDefault();
    searchDialogOpen.value = !searchDialogOpen.value;
  }
})
</script>
