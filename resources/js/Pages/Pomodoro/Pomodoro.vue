<script setup>
import { ref, computed } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

const { props } = usePage();
const auth = props.auth;

// Props
const prop = defineProps({
    timers: {
        type: Array,
        required: true,
    },
    save: {
        type: Function,
        required: true,
    },
});

// State Variables
const isRunning = ref(false);
const timerInstance = ref(null);
const totalSeconds = ref(25 * 60); // Default timer for Pomodoro
const currentTimer = ref(0);
const audioPath = "/audios/normalAlarm.mp3";

// Computed Properties
const displayMinutes = computed(() => {
    const minutes = Math.floor(totalSeconds.value / 60);
    return formatTime(minutes);
});

const displaySeconds = computed(() => {
    const seconds = totalSeconds.value % 60;
    return formatTime(seconds);
});

// Methods
function formatTime(time) {
    return time < 10 ? "0" + time : time.toString();
}

function start() {
    isRunning.value = true;
    //Form
    const form = useForm({
        duration: totalSeconds.value,
        timer_session_type_id: currentTimer.value + 1,
    });

    const errors = ref({});

    timerInstance.value = setInterval(() => {
        if (totalSeconds.value > 0) {
            totalSeconds.value--;
        } else {
            changeCurrentTimer(currentTimer.value);
            const audio = new Audio(audioPath);
            audio
                .play()
                .catch((error) =>
                    console.error("Audio playback failed:", error)
                );

            if (auth.user) {
                form.post("/timers", {
                    onError: (error) => {
                        errors.value = error;
                    },
                });
                console.log('successs');
            }
        }
    }, 1);
}

function stop() {
    isRunning.value = false;
    if (timerInstance.value) {
        clearInterval(timerInstance.value);
        timerInstance.value = null;
    }
}

function reset(minutes) {
    stop();
    totalSeconds.value = minutes * 60;
}

function changeCurrentTimer(index) {
    currentTimer.value = index;
    reset(prop.timers[index].minutes);
}
</script>

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
            class="countdown-timer max-w-[720px] flex items-center justify-center border-black dark:border-[#A24BF4] rounded-lg shadow-light dark:shadow-dark dark:text-shadow mx-auto py-2"
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
                <i class="bi bi-pause-btn text-7xl stop-icon" @click="stop"></i>

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

<style>
.timer-text {
    font-family: "Monomaniac One";
    color: #a24bf4;
}

@media (min-width: 1280px) {
    .timer-text {
        font-size: 200px;
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
        font-size: 180px;
        line-height: 160px;
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
        font-size: 130px;
        line-height: 100px;
        margin: 0 20px 20px;
    }
    .two-dot {
        font-size: 100px;
        margin-bottom: 10px;
    }
    .countdown-timer {
        border-width: 16px;
        padding: 0 !important;
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
        font-size: 66px;
        margin-bottom: 10px;
    }
    .countdown-timer {
        border-width: 12px;
        padding: 0 !important;
    }
}
</style>
