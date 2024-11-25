<template>
    <div>
        <!-- Toggle Button -->
        <Button
            @click="toggleMode"
            variant="ghost"
            class="px-4 py-1.5 rounded-lg hover:bg-accent hover:text-accent-foreground text-xl focus:outline-none transition duration-300"
        >
            <i class="bi bi-moon text-lg" v-if="isDarkMode"></i>
            <i class="bi bi-brightness-high text-xl" v-else></i>
        </Button>
    </div>
</template>

<script setup>
import { Button } from "@/components/ui/button";

import { ref, onMounted } from 'vue';

const isDarkMode = ref(false);

function toggleMode() {
    isDarkMode.value = !isDarkMode.value;
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDarkMode.value ? 'dark' : 'light');
}

onMounted(() => {
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        isDarkMode.value = true;
        document.documentElement.classList.add('dark');
    }
});
</script>

<style scoped>
/* Optional styles */
</style>
