<template>
    <div class="mx-auto flex flex-col gap-5 w-full">
        <!--Tabs navigation-->
        <ul
            class="max-w-[720px] flex list-none flex-row flex-wrap border-b-0 ps-0 my-6 mx-auto timer-mode"
            style="width: 72%"
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
                        'xl:text-2xl lg:text-xl leading-tight border-b-4 border-t-0 border-transparent px-6 pb-3.5 pt-4',
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
            class="countdown-timer max-w-[720px] flex items-center justify-center border-black dark:border-[#A24BF4] rounded-lg shadow-light dark:shadow-dark dark:text-shadow mx-auto"
            style="width: 72%"
        >
            <span class="timer-text dark:text-white">
                {{ displayMinutes }}
            </span>
            <span class="self-center two-dot"> : </span>
            <span class="timer-text dark:text-white">
                {{ displaySeconds }}
            </span>
        </div>

        <div class="flex justify-center">
            <div
                v-if="isRunning"
                class="flex items-center gap-4 cursor-pointer mt-3 timer-running"
                style="margin-left: 50px"
            >
                <i
                    class="bi bi-pause-btn text-7xl stop-icon"
                    @click="stop"
                ></i>

                <span
                    class="material-symbols-outlined text-4xl cursor-pointer reset-icon"
                    @click="reset(timers[currentTimer].minutes)"
                >
                    replay
                </span>
            </div>

            <div
                v-else
                class="bg-[#A24BF4] dark:bg-white mt-2 rounded-full flex items-center justify-center cursor-pointer p-0.5 pl-2"
                @click="start"
            >
                <i
                    class="bi bi-play-fill text-7xl text-white dark:text-[#A24BF4] play-icon"
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
    watch: {
        timerEnabled(value) {
            if (value) {
                setTimeout(() => {
                    this.timerCount--;
                }, 1000);
            }
        },

        timerCount: {
            handler(value) {
                if (value > 0 && this.timerEnabled) {
                    setTimeout(() => {
                        this.timerCount--;
                    }, 1000);
                }
            },
            immediate: true, // This ensures the watcher is triggered upon creation
        },
    },
    methods: {
        formatTime(time) {
            return time < 10 ? "0" + time : time.toString();
        },
        start() {
            this.isRunning = true;
            this.timerInstance = setInterval(() => {
                if (this.totalSeconds > 0) {
                    this.totalSeconds --;
                } else {
                    this.stop();
                    alert('Time is up!');
                }
            }, 1000);
        },
        stop() {
            this.isRunning = false;
            if (this.timerInstance) {
                clearInterval(this.timerInstance); // Clear the interval to stop the timer
                this.timerInstance = null; // Reset the timer instance
            }
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
    beforeDestroy() {
        // Cleanup: stop the timer when the component is destroyed
        this.stop();
    },
};
</script>

<style>
.timer-text {
    font-family: "Monomaniac One";
    color: #a24bf4;
}

@media (min-width: 1280px) {
    .timer-text {
        font-size: 220px;
        line-height: 180px;
        margin: 0 20px 40px;
    }

    .two-dot {
        font-size: 120px;
    }

    .countdown-timer {
        border-width: 20px;
    }
}
@media (max-width: 1280px) {
    .timer-text {
        font-size: 200px;
        line-height: 180px;
        margin: 0 20px 30px;
    }

    .two-dot {
        font-size: 100px;
    }

    .countdown-timer {
        border-width: 18px;
    }
}

@media (max-width: 1024px) {
    .timer-text {
        font-size: 145px;
        line-height: 140px;
        margin: 0 20px 30px;
    }
    .two-dot {
        font-size: 100px;
        margin-bottom: 10px;
    }
    .countdown-timer {
        border-width: 16px;
    }
    .timer-mode {
        margin: 30px auto !important;
    }
    .play-icon {
        font-size: 56px !important;
    }
    .stop-icon {
        font-size: 56px !important;
    }
    .reset-icon {
        font-size: 22px !important;
    }
    .timer-running {
        margin-left: 40px !important;
    }
}

@media (max-width: 860px) {
    .timer-text {
        font-size: 90px;
        line-height: 80px;
        margin: 0 20px 20px;
    }
    .two-dot {
        font-size: 100px;
        margin-bottom: 10px;
    }
}
</style>
