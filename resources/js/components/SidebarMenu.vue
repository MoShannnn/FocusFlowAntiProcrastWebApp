<template>
    <nav
        :class="toggleSidebar ? 'xl:w-4/12' : 'w-[4vh]'"
        class="relative z-[20] h-[100vh] flex-shrink-0 isolate transition-all duration-200"
    >
        <!-- Border Wrapper -->
        <div
            :class="toggleSidebar ? 'h-[87vh]' : 'h-[100vh]'"
            class="absolute left-0 bottom-0 w-full border-l border-black dark:border-white"
        ></div>

        <div class="h-full">
            
            <div
                :class="
                    toggleSidebar
                        ? 'xl:-left-10 md:-left-20'
                        : '-left-5 border-2 border-[#762DBB] bg-black dark:bg-white rounded-full'
                "
                class="absolute cursor-pointer top-3 w-10 h-10 flex items-center justify-center"
                @click="handleToggleSidebar"
            >
                <span
                    class="material-symbols-outlined transform transition-all duration-300 text-[#A24BF4] text-xl font-bold"
                    :class="toggleSidebar ? 'ml-1' : 'mr-1 -rotate-180'"
                >
                    arrow_forward_ios
                </span>
            </div>

            <SidebarMenuNav
                v-if="toggleSidebar"
                :toggle-sidebar="toggleSidebar"
                :timers="timers" 
                :save="save"
            />

        </div>
    </nav>
</template>

<script>
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

export default {
    props: {
        timers: {
            type: Array,
            required: true,
        },
        save: {
            type: Function,
            required: true,
        },
    },
    components: {
        SidebarMenuNav,
    },
    setup() {
        return {
            toggleSidebar,
            currentPath,
            handleToggleSidebar,
        };
    },
};
</script>

