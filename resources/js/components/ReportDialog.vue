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
import { AreaChart } from "@/components/ui/chart-area";
import { usePage, Link } from "@inertiajs/vue3";

const { props } = usePage();
const auth = props.auth;
const categories = props.categories; // An array of category objects
const tasks = props.tasks; // An array of task objects

// Initialize an empty array to store the month-wise data
const monthData = [
    { name: "Jan", total_task: 0, total_category: 0 },
    { name: "Feb", total_task: 0, total_category: 0 },
    { name: "Mar", total_task: 0, total_category: 0 },
    { name: "Apr", total_task: 0, total_category: 0 },
    { name: "May", total_task: 0, total_category: 0 },
    { name: "Jun", total_task: 0, total_category: 0 },
    { name: "Jul", total_task: 0, total_category: 0 },
    { name: "Aug", total_task: 0, total_category: 0 },
    { name: "Sep", total_task: 0, total_category: 0 },
    { name: "Oct", total_task: 0, total_category: 0 },
    { name: "Nov", total_task: 0, total_category: 0 },
    { name: "Dec", total_task: 0, total_category: 0 },
];

// Loop task and category count per month
tasks.forEach((task) => {
    const taskMonth = new Date(task.created_at).getMonth();

    monthData[taskMonth].total_task++;
});

categories.forEach((category) => {
    const categoryMonth = new Date(category.created_at).getMonth();
    monthData[categoryMonth].total_category++;
});
</script>

<template>
    <Dialog>
        <DialogTrigger asChild>
            <Button variant="ghost" class="text-md font-asap">
                <span class="material-symbols-outlined"> cadence </span>Report
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px] xl:min-w-[700px]">
            <DialogHeader>
                <DialogTitle>Tracking Report</DialogTitle>
                <DialogDescription>
                    Generate yearly report based on your activity
                </DialogDescription>
            </DialogHeader>
            <AreaChart
                v-if="auth.user"
                :data="monthData"
                index="name"
                :categories="['total_task', 'total_category']"
            />
            <div v-else class="flex flex-col justify-center items-center py-5 gap-2">
                <Button class="w-24">
                    <Link href="/login">
                        <DropdownMenuItem> Login</DropdownMenuItem>
                    </Link>
                </Button>
                You need to login to access this feature!
            </div>
        </DialogContent>
    </Dialog>
</template>
