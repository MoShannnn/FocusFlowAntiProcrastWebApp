<template>
    <Dialog>
        <DialogTrigger asChild>
            <Button variant="ghost" class="text-md font-asap">
                <span class="material-symbols-outlined"> alarm </span>Timer
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px] xl:min-w-[700px]">
            <DialogHeader>
                <DialogTitle>Customize Timer </DialogTitle>
                <DialogDescription>
                    Adjust each timer sessions for your needs
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4">
                <div class="grid w-full items-center gap-1.5" v-for="(timer, i) in updatedTimers" :key="i">
                    <Label :for="'timer-' + i">Timer {{ i + 1 }}</Label>
                    <Input v-model="timer.value" :placeholder="`Timer ${i + 1}`" />
                </div>
            </div>
            <DialogFooter>
                <Button type="submit">Save changes</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup>
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

</script>
