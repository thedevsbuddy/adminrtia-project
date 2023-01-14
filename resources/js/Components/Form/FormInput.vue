<template>
  <div :class="props.class">
    <label v-if="props.label" class="flex mb-2 text-sm font-medium text-slate-500 items-center space-x-1">
      <span>{{ props.label }}</span>
      <span v-if="props.required" class="font-bold text-red-500">*</span>
      <span v-if="props.isOptional" class="font-bold text-xs">(Optional)</span>
    </label>
    <input :type="props.type" v-bind="$attrs" :model-value="props.modelValue" @change="e => emit('update:modelValue', e.target.value)" :class="`w-full block rounded-0 text-sm text-slate-500 border ${props.error ? 'border-red-500' : ''} px-4 py-1.5 outline-none focus:ring-1 focus:ring-accent/50`" :placeholder="props.placeholder" />
    <span v-if="props.error" class="text-red-500 font-semibold text-xs tracking-wider">{{ props.error }}</span>
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: [String, Number],
  placeholder: String,
  label: String,
  error: String,
  type: {
    type: String,
    default: 'text',
  },
  class: String,
  required: Boolean,
})
const emit = defineEmits(['update:modelValue'])
</script>
