<template>
    <ul
        class="gap-3 overflow-y-auto overflow-x-hidden text-white transition-all duration-200 space-y-3"
    >
        <li class="group transition-all duration-200">
            <a
                href="/"
                :class="toggleSidebar ? 'flex flex-row items-start' : ''"
                class="font-medium cursor-pointer relative hover:text-white"
            >
                <span
                    class="whitespace-nowrap"
                    :class="[
                        isActive('/') && toggleSidebar
                            ? 'bg-[rgba(255,255,255,0.35)] group-hover:!bg-[rgba(255,255,255,0.35)]'
                            : '',
                        toggleSidebar
                            ? 'flex-1 text-xsm transition duration-300 h-10 flex items-center pl-2 group-hover:bg-[rgba(255,255,255,0.2)]'
                            : 'block mx-auto mt-1 text-center text-[10px]',
                    ]"
                >
                    Home
                </span>
            </a>
        </li>
        
    </ul>
</template>

<script setup>
import { ref } from "vue";

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
