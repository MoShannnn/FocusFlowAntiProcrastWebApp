<template>
    <div class="w-full absolute left-0 bottom-0 h-[87vh] px-10">
        <h1 class="font-asap text-4xl font-bold mb-5">Tasks</h1>

        <div
            v-for="todo in todos_asc"
            class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-4"
        >
            <Checkbox class="flex-none" />
            <Input
                type="text"
                class="flex-1 border-none h-8 font-asap text-2xl px-1"
                v-model="todo.content"
            />
            <div class="actions">
                <button class="delete" @click="removeTodo(todo)">Delete</button>
            </div>
        </div>
        <form v-if="showInput" class="p-2 bg-neutral-100 dark:bg-neutral-900 rounded-xl" @submit.prevent="addTodo">
            <div class="grid gap-4">
                <Input class="flex-1 h-12 text-2xl" v-model="input_content" />
                <div class="flex flex-row justify-end gap-4">
                    <Button
                        type="submit"
                        class="text-xl h-11 px-8"
                        @click="saveTask"
                        >Save</Button
                    >
                    <Button
                        type="cancel"
                        variant="secondary"
                        class="text-xl h-11 px-8"
                        @click="cancelTask"
                        >Cancel</Button
                    >
                </div>
            </div>
        </form>

        <Button
            v-else
            @click="toggleInput"
            class="w-full flex items-center p-7 text-xl font-asap text-black border-4 border-dashed border-spacing border-[#B3AEAE] bg-[#FFFBFF] hover:bg-neutral-100 dark:text-white dark:bg-[#2f2929]/50 dark:hover:bg-[#2f2929]/40 dark:border-[#D3D3D3]/50"
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
