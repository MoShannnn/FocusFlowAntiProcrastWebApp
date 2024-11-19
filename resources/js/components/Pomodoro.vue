<template>
    <div class="mx-auto flex flex-col gap-5">
        <!--Tabs navigation-->
        <ul
            class="flex list-none flex-row flex-wrap border-b-0 ps-0 my-10 mx-auto"
            style="width: 80%"
        >
            <li
                v-for="(timer, index) in timers"
                :key="timer.name"
                class="flex-auto text-center"
            >
                <a
                    @click="!isRunning && changeCurrentTimer(index)"
                    :style="{ fontFamily: 'BenchNine' }"
                    :class="[
                        'text-2xl leading-tight border-b-4 border-t-0 border-transparent px-10 pb-3.5 pt-4',
                        {
                            'cursor-pointer hover:bg-neutral-100 focus:isolate focus:border-transparent dark:text-white dark:hover:bg-neutral-700/60':
                                !isRunning,
                            'border-b-[#A24BF4] dark:bg-zinc-950':
                                currentTimer === index,
                            'cursor-not-allowed opacity-60': isRunning,
                        },
                    ]"
                    :aria-selected="currentTimer === index"
                    :aria-controls="'tabs-' + timer.name"
                >
                    {{ timer.name }}
                </a>
            </li>
        </ul>

        <div
            v-if="timers[currentTimer]"
            class="flex items-center justify-center border-black dark:border-[#A24BF4] rounded-lg px-5 shadow-light dark:shadow-dark dark:text-shadow mx-auto"
            style="border-width: 20px; width: 96%"
        >
            <span class="timer-text dark:text-white">
                {{ displayMinutes }}
            </span>
            <span class="self-center" style="font-size: 160px"> : </span>
            <span class="timer-text dark:text-white">
                {{ displaySeconds }}
            </span>
        </div>

        <div class="flex justify-center">
            <div
                v-if="isRunning"
                class="flex items-center gap-4 cursor-pointer"
                style="margin-left: 60px"
            >
                <i
                    class="bi bi-pause-btn"
                    @click="stop"
                    style="font-size: 84px"
                ></i>

                <span
                    class="material-symbols-outlined text-4xl cursor-pointer"
                    @click="reset(timers[currentTimer].minutes)"
                >
                    replay
                </span>
            </div>

            <div
                v-else
                class="w-22 h-22 bg-[#A24BF4] dark:bg-white mt-2 rounded-full flex items-center justify-center cursor-pointer pt-1.5 pl-2"
                @click="start"
            >
                <i
                    class="bi bi-play-fill text-7xl text-white dark:text-[#A24BF4]"
                ></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        timers: {
            type: Array,
            required: true,
        },
        save: {
            type: Function,
            required: true,
        },
    },
    data() {
        return {
            isRunning: false,
            timerInstance: null,
            totalSeconds: 25 * 60, // Default timer for Pomodoro
            currentTimer: 0,
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
.timer-text {
    font-size: 250px;
    line-height: 200px;
    font-family: "Monomaniac One";
    margin: 0 20px 50px;
    color: #a24bf4;
}
</style>
