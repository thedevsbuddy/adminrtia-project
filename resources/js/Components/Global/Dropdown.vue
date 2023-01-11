<template>
    <button @click="toggleDropdown" class="relative">
      <slot name="dropdownLabel" />
    </button>
    <Transition
        duration="500ms"
        enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-1 translate-y-0"
        leave-from-class="opacity-1 translate-y-0"
        leave-to-class="opacity-0 translate-y-4">
        <div v-if="isOpen" class="absolute block top-full right-0 min-w-48 bg-white rounded shadow z-50">
          <slot name="dropdownOptions" />
        </div>
    </Transition>
</template>
<script setup>
import {defineProps, onMounted, ref} from "vue";
import DropdownItem from "./DropdownItem";

const isOpen = ref(false);

const props = defineProps({
  label: {
    type: String,
    default: "Dropdown button"
  },
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
