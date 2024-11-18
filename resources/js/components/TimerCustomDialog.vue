<template>
    <Dialog>
        <DialogTrigger asChild>
            <Button variant="ghost" class="text-xl" style="font-family: 'Asap'">
                <span class="material-symbols-outlined"> alarm </span>Timer
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px] xl:min-w-[700px]">
            <DialogHeader class="text-center">
                <DialogTitle>Customize Timer</DialogTitle>
                <DialogDescription>
                    Customize each timer sessions
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4">
                <div class="grid w-full items-center gap-1.5">
                    <Label htmlFor="name"> Pomodoro </Label>
                    <Input
                        v-for="(timer, i) in updatedTimers"
                        :key="i"
                        v-model="updatedTimers[i]"
                    />
                </div>
            </div>
            <DialogFooter>
                <Button @click="save(updatedTimers)" type="submit">
                    Save changes
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";

import { Button } from "@/components/ui/button";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

// Props
defineProps({
    timers: {
        type: Array,
        required: true,
    },
    save: {
        type: Function,
        required: true,
    },
});

// Reactive Data
const updatedTimers = ref([]);

// Lifecycle Hook
onMounted(() => {
    updatedTimers.value = timers.map((timer) => timer.minutes);
});
</script>