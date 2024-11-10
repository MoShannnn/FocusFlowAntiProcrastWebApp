<script setup>
import SidebarMenu from "../../components/SidebarMenu.vue";
</script>

<template>
    <div class="flex">
        <div
            class="flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5 bg-[#151515] text-white"
        >
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>
        </div>
        <SidebarMenu />
    </div>
</template>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
