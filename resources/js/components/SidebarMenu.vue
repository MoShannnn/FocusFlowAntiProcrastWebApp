<template>
    <nav
        :class="toggleSidebar ? 'w-4/12' : 'w-[30px]'"
        class="relative z-[51] flex-shrink-0 bg-[#151515] h-[100vh] isolate transition-all duration-200 border border-r-white"
    >
        <div class="h-full pt-4">
            <div class="flex flex-col justify-between h-full">
                <div class="flex-1 flex flex-col gap-4 overflow-y-auto">
                    <SidebarMenuNav
                        v-if="toggleSidebar"
                        :toggle-sidebar="toggleSidebar"
                    />
                </div>
                <div
                    class="absolute cursor-pointer -left-5 top-9 w-10 h-10 border-2 border-[#762DBB] bg-white rounded-full flex items-center justify-center"
                    @click="handleToggleSidebar"
                >
                    <span
                        class="material-symbols-outlined transform transition-all duration-300 text-[#A24BF4] text-xl font-bold"
                        :class="toggleSidebar ? 'ml-1' : 'mr-1 -rotate-180'"
                    >
                        arrow_forward_ios
                    </span>

                    <div
                        class="absolute min-w-[88px] -right-[100px] opacity-0 pointer-events-none group-hover/logout:opacity-100 group-hover/logout:pointer-events-auto transition duration-300 text-xs text-center text-white bg-slate-700 shadow-[0_4px_6px_0_rgba(0,0,0,0.25)] rounded p-2"
                    >
                        <span>Open/Collapse</span>
                        <span
                            class="absolute -left-3 w-0 h-0 border-t-[7px] border-t-transparent border-r-[12px] border-r-slate-700 border-b-[7px] border-b-transparent"
                        ></span>
                    </div>
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
