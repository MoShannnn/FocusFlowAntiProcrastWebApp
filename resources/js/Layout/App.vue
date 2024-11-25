<template>
    <div class="flex">
        <div
            class="flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5"
        >
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <CurrentTask />

            <Pomodoro :timers="timers" :save="save" />
        </div>

        <SidebarMenu :timers="timers" :save="save" />
    </div>
</template>

<script>
import SidebarMenu from "../../components/SidebarMenu.vue";
import Pomodoro from "../../components/Pomodoro.vue";
import Pomodoro from "../../components/CurrentTask.vue";

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
