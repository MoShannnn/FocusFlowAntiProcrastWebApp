<template>
    <div>
        <!-- Toggle Button -->
        <Button
            @click="toggleMode"
            class="px-4 py-1.5 rounded-lg hover:bg-accent hover:text-accent-foreground text-xl focus:outline-none transition duration-300"
        >
            <i class="bi bi-moon text-lg" v-if="isDarkMode"></i>
            <i class="bi bi-brightness-high text-xl" v-else></i>
        </Button>
    </div>
</template>

<script>
import { Button } from "@/components/ui/button";

export default {
    data() {
        return {
            isDarkMode: false, // Tracks the current mode
        };
    },
    methods: {
        toggleMode() {
            this.isDarkMode = !this.isDarkMode;
            // Add/remove the "dark" class on the root element
            if (this.isDarkMode) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
            // Optionally, save the mode to localStorage
            localStorage.setItem("theme", this.isDarkMode ? "dark" : "light");
        },
    },
    mounted() {
        // On mount, check for the saved mode or system preference
        const savedTheme = localStorage.getItem("theme");
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;

        if (savedTheme === "dark" || (!savedTheme && prefersDark)) {
            this.isDarkMode = true;
            document.documentElement.classList.add("dark");
        }
    },
};
</script>

<style scoped>
/* Optional styles */
</style>
