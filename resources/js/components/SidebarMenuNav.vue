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
                    :class="[
                        !toggleSidebar
                            ? 'rounded-[8px] ml-5 w-8 h-8'
                            : 'pl-5 h-10 w-10',
                        isActive('/')
                            ? 'bg-[rgba(255,255,255,0.35)]'
                            : 'group-hover:bg-[rgba(255,255,255,0.2)]',
                    ]"
                    class="flex items-center flex-shrink-0 justify-center flex-shrink-0 group-hover:text-white hover:!text-white transition duration-300 relative"
                >
                    <span class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            fill="currentColor"
                            viewBox="0 0 18 18"
                            class="w-5 h-5"
                        >
                            <path
                                d="M7.5 15.375v-4.5h3v4.5h3.75v-6h2.25L9 2.625l-7.5 6.75h2.25v6H7.5Z"
                            ></path>
                        </svg>
                    </span>
                </span>

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
