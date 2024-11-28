
<script setup lang="ts">
import Button from './ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';
const { url } = usePage();

interface Item {
  title: string
  href: string
}

const sidebarNavItems: Item[] = [
  {
    title: 'Profile',
    href: '/settings',
  },
  {
    title: 'Change Password',
    href: '/reset-password',
  },
]
</script>

<template>
  <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">
    <Button
    v-for="item in sidebarNavItems"
    :key="item.title"
    as="a"
    :href="item.href"
    variant="ghost"
    :class="[
      'w-full text-left justify-start',
      url === item.href && 'bg-muted hover:bg-muted', // Match the current route
    ]"
    @click.prevent="$inertia.visit(item.href)" 
  >
    {{ item.title }}
  </Button>
  </nav>
</template>
