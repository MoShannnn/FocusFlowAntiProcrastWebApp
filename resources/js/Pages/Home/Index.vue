<template>
    <div class="flex">
        <div
            class="flex flex-col flex-1 min-w-0 h-screen overflow-hidden p-5 bg-[#151515] text-white"
        >
            <h1 class="ml-5 text-2xl" style="font-family: 'Londrina Solid'">
                Focus Flow
            </h1>

            <!--Tabs navigation-->
            <ul
                class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0"
                role="tablist"
            >
                <li
                    v-for="(timer, index) in timers"
                    :key="timer.name"
                    :class="[
                        'flex-auto text-center',
                        { 'border-b-2 border-primary': currentTimer === index },
                    ]"
                    role="presentation"
                >
                    <a
                        @click="changeCurrentTimer(index)"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                        :class="{ 'text-primary': currentTimer === index }"
                        aria-selected="true"
                        :aria-controls="'tabs-' + timer.name"
                    >
                        {{ timer.name }}
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="p-5">
                <div
                    v-if="timers[currentTimer]"
                    color="basil"
                    flat
                    class="pa-5 d-flex flex-column justify-center align-center"
                >
                    <h1 class="text-9xl">
                        {{ displayMinutes }}:{{ displaySeconds }}
                    </h1>
                    <div class="button-group">
                        <span class="material-symbols-outlined" @click="start">
                            play_arrow
                        </span>

                        <span class="material-symbols-outlined" @click="stop">
                            pause
                        </span>
                        <span
                            class="material-symbols-outlined"
                            @click="reset(timers[currentTimer].minutes)"
                            :disabled="isRunning"
                        >
                            replay
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <SidebarMenu />
    </div>
</template>

<script>
import SidebarMenu from "../../components/SidebarMenu.vue";

export default {
    components: {
    SidebarMenu
  },
    data() {
        return {
            isRunning: false,
            timerInstance: null,
            totalSeconds: 25 * 60, // Default timer for Pomodoro
            currentTimer: 0,
            timers: [
                {
                    name: "Pomodoro",
                    minutes: 25,
                },
                {
                    name: "Short Break",
                    minutes: 5,
                },
                {
                    name: "Long Break",
                    minutes: 10,
                },
            ],
        };
    },
    computed: {
        displayMinutes() {
            const minutes = Math.floor(this.totalSeconds / 60);
            return this.formatTime(minutes);
        },
        displaySeconds() {
            const seconds = this.totalSeconds % 60;
            return this.formatTime(seconds);
        },
    },
    methods: {
        formatTime(time) {
            return time < 10 ? "0" + time : time.toString();
        },
        start() {
            this.stop();
            this.isRunning = true;
            this.timerInstance = setInterval(() => {
                if (this.totalSeconds > 0) {
                    this.totalSeconds -= 1;
                } else {
                    this.stop();
                }
            }, 1000);
        },
        stop() {
            this.isRunning = false;
            clearInterval(this.timerInstance);
        },
        reset(minutes) {
            this.stop();
            this.totalSeconds = minutes * 60;
        },
        changeCurrentTimer(index) {
            this.currentTimer = index;
            this.reset(this.timers[index].minutes);
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
