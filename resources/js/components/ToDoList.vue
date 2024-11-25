<template>
    <div class="w-full absolute left-0 bottom-0 h-[87vh] px-10">
        <h1 class="font-asap xl:text-3xl lg:text-2xl text-lg font-bold mb-5">Tasks</h1>

        <div
            v-for="todo in todos_asc"
            class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-4"
        >
            <Checkbox class="flex-none" />
            <Input
                type="text"
                class="flex-1 border-none h-6 font-asap xl:text-xl lg:text-lg text-base px-1"
                v-model="todo.content"
            />
            <div class="actions">
                <button class="delete xl:text-base text-xs" @click="removeTodo(todo)">Delete</button>
            </div>
        </div>

        <!-- Add New Task Form -->
        <form
            v-if="showInput"
            class="p-2 bg-neutral-100 dark:bg-neutral-900 rounded-xl"
            @submit.prevent="addTodo"
        >
            <div class="grid gap-4">

                <Input
                    class="flex-1 xl:text-xl lg:text-lg outline-none ring-2 ring-ring ring-offset-2"
                    v-model="input_content"
                    autofocus
                />

                <div class="flex flex-row justify-end gap-4">
                    <Button
                        type="submit"
                        @click="saveTask"
                        >Save</Button
                    >
                    <Button
                        type="cancel"
                        variant="secondary"
                        @click="cancelTask"
                        >Cancel</Button
                    >
                </div>

            </div>
        </form>

        <Button
            v-else
            @click="toggleInput"
            class="w-full flex items-center h-12 xl:text-xl lg:text-lg font-asap text-black border-2 border-dashed border-spacing border-[#B3AEAE]/50 bg-[#FFFBFF] hover:bg-neutral-50 dark:text-white dark:bg-[#2f2929]/50 dark:hover:bg-[#2f2929]/40 dark:border-[#D3D3D3]/50"
        >
            Add new task
            <span class="material-symbols-outlined"> add </span>
        </Button>
    </div>
</template>

<script setup>
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Button } from "./ui/button/index";

import { ref, onMounted, computed, watch } from "vue";

const todos = ref([]);

const showInput = ref(false);
const input_content = ref("");

const toggleInput = () => {
    showInput.value = !showInput.value; // Toggles visibility
};

const todos_asc = computed(() =>
    todos.value.sort((a, b) => {
        return a.createdAt - b.createdAt;
    })
);

watch(
    todos,
    (newVal) => {
        localStorage.setItem("todos", JSON.stringify(newVal));
    },
    {
        deep: true,
    }
);

const addTodo = () => {
    if (input_content.value.trim() === "") {
        return;
    }

    todos.value.push({
        content: input_content.value,
        done: false,
        editable: false,
        createdAt: new Date().getTime(),
    });

    input_content.value = "";
};

const cancelTask = () => {
    input_content.value = "";
    showInput.value = false;
};

const removeTodo = (todo) => {
    todos.value = todos.value.filter((t) => t !== todo);
};

onMounted(() => {
    todos.value = JSON.parse(localStorage.getItem("todos")) || [];
});
</script>

<style>
.border-spacing {
    border-spacing: 10px;
}
</style>
