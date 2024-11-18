<template>
    <div class="flex flex-row px-4 gap-8 items-center justify-center">
        <ReportDialog/>
        <TimerCustomDialog/>
        <ModeToggle />
        <ProfileDialog/>
    </div>
</template>

<script setup>
import { ref } from "vue";
import ModeToggle from "@/components/ModeToggle.vue";
import ReportDialog from "@/components/ReportDialog.vue";
import TimerCustomDialog from "./TimerCustomDialog.vue";
import ProfileDialog from "./ProfileDialog.vue";

const props = defineProps({
    toggleSidebar: {
        type: [Boolean, null],
        required: false,
        default: false,
    },
});

const currentPath = ref(window.location.pathname);

const isActive = (route) => {
    return currentPath.value === route;
};

window.addEventListener("popstate", () => {
    currentPath.value = window.location.pathname;
});
</script>
