<template>
  <div class="shrink-0 h-12 bg-slate-800 text-light border-b sticky top-0">
    <nav class="px-4 py-2 flex items-center justify-between h-full">
      <ul class="flex h-full items-center space-x-2 ">
        <li>
          <Link class="block" href="#">
            <icon name="menu" class="w-6 h-6"/>
          </Link>
        </li>
      </ul>
      <div class="flex items-center space-x-3">
        <div
            class="group bg-slate-900 hover:bg-slate-700 transition ease-in-out transition-colors duration-300  cursor-pointer rounded-lg w-56 h-8 flex items-center justify-between px-2">
          <div class="flex items-center">
            <icon name="search"/>
            <span class="text-sm pl-1">Search here...</span>
          </div>
          <span class="rounded bg-slate-700 transition ease-in-out transition-colors duration-300 group-hover:bg-slate-900  rounded-lg px-2 -mr-1">Ctrl+k</span>
        </div>
        <Link href="#" class="flex h-8 items-center bg-slate-900 text-light rounded-lg py-1 px-4 text-sm font-medium space-x-1">
          <icon name="builder" class="w-4 h-4"/>
          <span>Builder</span>
        </Link>
        <dropdown label="Account Setting">
          <template #dropdownLabel>
            <icon name="setting"/>
          </template>
          <template #dropdownOptions>
            <Link href="/" v-for="(option, i) in dropdownOptions" :key="i">
              <dropdown-item class="text-gray-700">{{ option.label }}</dropdown-item>
            </Link>
          </template>
        </dropdown>
      </div>

    </nav>
  </div>
</template>
<script setup>
import {defineProps, onMounted, ref} from "vue";

const isSearchOpened = ref(false);
const props = defineProps({
  isSearchOpen: Boolean,
})

onMounted(() => {
  isSearchOpened.value = props.isSearchOpen;
})

const dropdownOptions = [
  {
    label: "Profile",
  },
  {
    label: "Settings",
  },
  {
    label: "Sign out",
  },
];
</script>
