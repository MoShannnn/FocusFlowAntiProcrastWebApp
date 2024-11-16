<template>
    <nav
        :class="toggleSidebar ? 'w-[50vh]' : 'w-[4vh]'"
        class="relative z-[51] h-[100vh] flex-shrink-0 isolate transition-all duration-200"
    >
        <div 
        :class="toggleSidebar ? 'h-[87vh]' : 'h-[100vh]'"
        class="absolute left-0 bottom-0 w-full border-l border-black dark:border-white"
        ></div>

        <div class="h-full pt-4">
            <div class="flex flex-col justify-between h-full">
                <SidebarMenuNav
                    v-if="toggleSidebar"
                    :toggle-sidebar="toggleSidebar"
                />
                <div
                :class="toggleSidebar ? '-left-20' : '-left-5 border-2 border-[#762DBB] bg-black dark:bg-white rounded-full'"
                    class="absolute cursor-pointer top-6 w-10 h-10 flex items-center justify-center"
                    @click="handleToggleSidebar"
                >
                    <span
                        class="material-symbols-outlined transform transition-all duration-300 text-white dark:text-[#A24BF4] text-xl font-bold"
                        :class="toggleSidebar ? 'ml-1' : 'mr-1 -rotate-180'"
                    >
                        arrow_forward_ios
                    </span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import SidebarMenuNav from "./SidebarMenuNav.vue";

const toggleSidebar = ref(
    localStorage.getItem("toggleSidebar") === "true" || false
);
const currentPath = ref(window.location.pathname);

const handleToggleSidebar = () => {
    toggleSidebar.value = !toggleSidebar.value;

    if (toggleSidebar.value) {
        localStorage.setItem("toggleSidebar", "true");
    } else {
        localStorage.removeItem("toggleSidebar");
    }
};

window.addEventListener("popstate", () => {
    currentPath.value = window.location.pathname;
});
</script>
