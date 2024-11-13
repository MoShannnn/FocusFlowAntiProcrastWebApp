<template>
    <li role="presentation" class="flex-auto text-center">
        <a
            href="#"
            @click.prevent="selectTab"
            :class="{
                'border-b-2 border-primary': isActive,
                'text-primary': isActive,
                'text-neutral-500': !isActive
            }"
            role="tab"
            :aria-selected="isActive.toString()"
        >
            {{ label }}
        </a>
    </li>
</template>

<script setup>
defineProps({
  label: {
    type: String,
    required: true
  },
  index: {
    type: Number,
    required: true
  },
  activeTab: {
    type: Number,
    required: true
  }
});

const emit = defineEmits();

const isActive = computed(() => activeTab === index);

const selectTab = () => {
  emit('update:modelValue', index);
};
</script>
