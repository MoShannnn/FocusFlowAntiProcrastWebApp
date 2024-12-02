<template>
    <nav
        :class="toggleSidebar ? 'md:w-4/12 w-screen' : 'w-[4vh]'"
        class="relative z-[20] h-[100vh] flex-shrink-0 isolate transition-all duration-200"
    >
        <!-- Border Wrapper -->
        <div :class="toggleSidebar ? 'h-[90vh]' : 'h-[100vh]'" class="absolute left-0 bottom-0 w-full border-l border-black dark:border-white"></div>

        <div class="h-full pt-3">
            
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

            <!-- Start Expanded Sibebar Menu Navigation-->
                <SidebarMenuNav
                    v-if="toggleSidebar"
                    :toggle-sidebar="toggleSidebar"
                    :timers="timers" 
                    :save="save"
                />
            <!-- End Expanded Sibebar Menu Navigation-->

        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import SidebarMenuNav from "./SidebarMenuNav.vue";

// Props
defineProps({
  timers: {
    type: Array,
    required: true,
  },
  save: {
    type: Function,
    required: true,
  },
});

// Reactive variables
const toggleSidebar = ref(
  localStorage.getItem("toggleSidebar") === "true" || false
);
const currentPath = ref(window.location.pathname);

// Methods
const handleToggleSidebar = () => {
  toggleSidebar.value = !toggleSidebar.value;

  if (toggleSidebar.value) {
    localStorage.setItem("toggleSidebar", "true");
  } else {
    localStorage.removeItem("toggleSidebar");
  }
};

// Watch for browser navigation changes
onMounted(() => {
  window.addEventListener("popstate", () => {
    currentPath.value = window.location.pathname;
  });
});
</script>

