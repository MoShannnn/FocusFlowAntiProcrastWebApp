<script setup>
import SidebarMenu from '../../components/SidebarMenu.vue';
</script>

<template>
  <div class="flex justify-between">
    <div class=" flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5 bg-[#151515] text-white">
      Content Section
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
