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

// Define props using `defineProps`
defineProps({
    toggleSidebar: {
        type: [Boolean, null],
        required: false,
        default: false,
    },
    timers: {
        type: Array,
        required: true,
    },
    save: {
        type: Function,
        required: true,
    },
});
</script>

