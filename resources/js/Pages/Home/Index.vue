<template>
    <div class="flex">
        <div
            class="flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5"
        >
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <div class="w-[1029px] h-[66px] relative" style="margin: 120px auto 50px;">
                <div
                    class="w-[1024px] h-[66px] left-[5px] top-0 absolute rounded-[20px] shadow border-4 border-[#3b1161]"
                ></div>
                <div
                    class="w-[530.94px] left-[331.38px] top-[13px] absolute text-[34px] font-normal tracking-widest"
                >
                    UI Design for Focus Flow
                </div>
                <div
                    class="w-5 h-[65px] left-[20px] top-[65px] absolute origin-top-left -rotate-180 bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
                ></div>
                <div
                    class="w-5 h-[65px] left-[1009px] top-[1px] absolute bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
                ></div>
            </div>

            <Pomodoro />
        </div>

        <SidebarMenu />
    </div>
</template>

<script>
import SidebarMenu from "../../components/SidebarMenu.vue";
import Pomodoro from "../../components/Pomodoro.vue";

export default {
    components: {
        SidebarMenu,
        Pomodoro,
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
