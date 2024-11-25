<script setup>
import { ref } from "vue";
import SidebarMenu from "./SidebarMenu/SidebarMenu.vue";
import Pomodoro from "./Pomodoro/Pomodoro.vue";
import CurrentTask from "../components/CurrentTask.vue";

// Define the timers array as a reactive reference
const timers = ref([
    { name: "Pomodoro", minutes: 25 },
    { name: "Short Break", minutes: 5 },
    { name: "Long Break", minutes: 10 },
]);

// The save function will update the timers array
const save = (updatedTimers) => {
    // Update the timers array with the new values
    timers.value = timers.value.map((timer, i) => ({
        ...timer,
        minutes: parseInt(updatedTimers[i]),
    }));
};
</script>

<template>
    <div class="flex">
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden p-5 relative">
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <div class="h-[87vh] pt-6">
                <CurrentTask />

                <Pomodoro :timers="timers" :save="save" />
            </div>
        </div>

        <SidebarMenu :timers="timers" :save="save" />
        <!-- w-full absolute left-0 bottom-0 h-[87vh] px-10 -->
    </div>
</template>
