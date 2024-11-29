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

import { ref } from 'vue';

const props = defineProps({
  timers: {
    type: Array,
    required: true,
  },
  save: {
    type: Function,
    required: true,
  },
});

const updatedTimers = ref([...props.timers]);

</script>

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
                    <Label :for="'timer-' + i">{{ timer.name }}</Label>
                    <Input v-model="updatedTimers[i].minutes" maxlength="3" />
                </div>
            </div>
            <DialogFooter>
                <Button type="submit" @click="save(updatedTimers)">Save changes</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>