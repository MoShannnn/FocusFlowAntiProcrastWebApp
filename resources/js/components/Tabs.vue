<template>
    <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist">
        <slot></slot>
    </ul>
</template>

<script setup>
defineProps({
  modelValue: {
    type: Number,
    required: true,
  },
});

defineEmits(['update:modelValue']);
</script>
