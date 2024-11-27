<script setup>
import { ref } from "vue";
import SidebarMenu from "./SidebarMenu/SidebarMenu.vue";
import Pomodoro from "./Pomodoro/Pomodoro.vue";
import CurrentTask from "../components/CurrentTask.vue";

const timers = ref([
    { name: "Pomodoro", minutes: 25 },
    { name: "Short Break", minutes: 5 },
    { name: "Long Break", minutes: 10 },
]);

// The save function updates the timers array
const save = (updatedTimers) => {
    timers.value = updatedTimers.map(timer => ({
        ...timer,
        minutes: parseInt(timer.minutes, 10), // Ensure minutes are numbers
    }));
    alert('Success Updated!');
    this.timers = [...updatedTimers];
};
</script>

<template>
    <div class="flex">
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden p-5 relative">
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <div class="h-[87vh] paddingTop" style="padding-top: 8%">
                <CurrentTask />

                <Pomodoro :timers="timers" :save="save" />
            </div>
        </div>

        <SidebarMenu :timers="timers" :save="save" />
    </div>
</template>

<style>
@media (max-width: 1280px) and (max-height: 720px) {
    .paddingTop {
        padding-top: 5% !important;
    }
}
</style>
