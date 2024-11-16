<template>
    <div class="m-5">
        <ModeToggle />

    </div>

</template>

<script setup>
import { ref } from "vue";
import { Button } from "@/components/ui/button";
import ModeToggle from "@/components/ModeToggle.vue";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

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
