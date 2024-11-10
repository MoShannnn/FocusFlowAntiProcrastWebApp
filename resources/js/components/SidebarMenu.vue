<template>
    <nav
        :class="toggleSidebar ? 'w-4/12' : 'w-[56px]'"
        class="relative z-[51] flex-shrink-0 bg-[#151515] h-[100vh] isolate transition-all duration-200 border border-r-white"
    >
        <div class="h-full pt-4">
            <div class="flex flex-col justify-between h-full">
                <div class="flex-1 flex flex-col gap-4 overflow-y-auto">
                    <SidebarMenuNav v-if="toggleSidebar" :toggle-sidebar="toggleSidebar" />

                </div>
                <ul class="text-white pt-9">
                    <li
                        class="relative h-12 flex items-center justify-end pr-7 cursor-pointer text-white bg-[rgba(255,255,255,0.2)] group/logout"
                        @click="handleToggleSidebar"
                    >
                        <div
                            class="transform transition-all duration-300"
                            :class="toggleSidebar ? '' : '-rotate-180'"
                        >
                            <span class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                    class="w-6 h-6"
                                >
                                    <path
                                        d="m8.001 2.666-.94.94 3.72 3.727H2.668v1.333h8.113l-3.72 3.727.94.94 5.334-5.334L8 2.666Z"
                                    ></path>
                                </svg>
                            </span>
                        </div>

                        <div
                            class="absolute min-w-[88px] -right-[100px] opacity-0 pointer-events-none group-hover/logout:opacity-100 group-hover/logout:pointer-events-auto transition duration-300 text-xs text-center text-white bg-slate-700 shadow-[0_4px_6px_0_rgba(0,0,0,0.25)] rounded p-2"
                        >
                            <span>Open/Collapse</span>
                            <span
                                class="absolute -left-3 w-0 h-0 border-t-[7px] border-t-transparent border-r-[12px] border-r-slate-700 border-b-[7px] border-b-transparent"
                            ></span>
                        </div>
                    </li>
                </ul>
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
