<template>
    <div class="flex">
        <div
            class="flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5"
        >
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <div class="w-10/12 max-w-[850px] h-[50px] relative" style="margin: 80px auto 30px;">
               
                <div
                        class="w-full h-[50px] top-0 absolute rounded-[20px] shadow border-4 border-[#3b1161] text-2xl font-normal tracking-widest flex items-center justify-center"
                    >
                        UI Design for Focus Flow
                    </div>

                    <div
                        class="w-5 h-[50px] left-[20px] top-[50px] absolute origin-top-left -rotate-180 bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
                    ></div>
                    <div
                        class="w-5 h-[50px] right-[0px] top-[1px] absolute bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
                    ></div>
            </div>

            <Pomodoro :timers="timers" :save="save" />
        </div>

        <SidebarMenu :timers="timers" :save="save" />
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
    data() {
        return {
            timers: [
                { name: "Pomodoro", minutes: 25 },
                { name: "Short Break", minutes: 5 },
                { name: "Long Break", minutes: 10 },
            ],
        };
    },
    methods: {
        save(updatedTimers) {
            // Update the timers array with the new values
            this.timers = this.timers.map((timer, i) => ({
                ...timer,
                minutes: parseInt(updatedTimers[i]),
            }));
        },
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
