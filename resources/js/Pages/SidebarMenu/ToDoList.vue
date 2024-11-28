<script setup>
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Button } from "../../components/ui/button/index";

import { ref, onMounted, computed, watch } from "vue";

import { useForm, usePage } from "@inertiajs/vue3";

const { props } = usePage();
const auth = props.auth;

// defineProps({
//     tasks: Array,
// });
defineProps({
    tasks: {
        type: Array,
        default: () => [],
    },
    posts: {
        type: Array,
        default: () => [],
    },
});

const todos = ref([]);
const errors = ref({});

const showCategoryInput = ref(false);
const showTaskInput = ref(false);

const category_content = ref("");
const task_content = ref("");

const toggleCategoryInput = () => {
    showCategoryInput.value = !showCategoryInput.value; // Toggles visibility
};

const toggleTaskInput = () => {
    showTaskInput.value = !showTaskInput.value; // Toggles visibility
};

const todos_asc = computed(() =>
    todos.value.sort((a, b) => {
        return a.createdAt - b.createdAt;
    })
);

const handleCheckboxChange = (index, checked) => {
    todos.value[index].done = checked;
};

watch(
    todos,
    (newVal) => {
        localStorage.setItem("todos", JSON.stringify(newVal));
    },
    {
        deep: true,
    }
);

const addCategory = () => {
    if (category_content.value.trim() === "") {
        return;
    }

    if (auth.user) {
        //Form
        const form = useForm({
            name: category_content.value,
        });

        form.post("/categories", {
            onError: (error) => {
                errors.value = error;
            },
        });
    }

    showCategoryInput.value = false;
    category_content.value = "";
};

const addTodo = () => {
    if (task_content.value.trim() === "") {
        return;
    }

    todos.value.push({
        content: task_content.value,
        done: false,
        editable: false,
        createdAt: new Date().getTime(),
    });

    if (auth.user) {
        //Form
        const form = useForm({
            name: task_content.value,
            status: 0,
        });

        form.post("/tasks", {
            onError: (error) => {
                errors.value = error;
            },
        });
    }

    task_content.value = "";
};

const cancelCategory = () => {
    category_content.value = "";
    showCategoryInput.value = false;
};

const cancelTask = () => {
    task_content.value = "";
    showTaskInput.value = false;
};

const removeTodo = (todo) => {
    if (auth.user) {
        console.log(todo);
        const form = useForm({});
        form.delete(`tasks/${todo.index}`, {
            onError: (error) => {
                errors.value = error;
            },
        });
    }

    todos.value = todos.value.filter((t) => t !== todo);
};

onMounted(() => {
    todos.value = JSON.parse(localStorage.getItem("todos")) || [];
});
</script>

<template>
    <div class="w-full absolute left-0 bottom-0 h-[87vh] px-10">
        <h1 class="font-asap xl:text-3xl lg:text-2xl text-lg font-bold">
            Tasks
            <div v-if="posts && posts.length > 0">
                <!-- Render tasks -->
            </div>
            <div v-else>No posts available.</div>
        </h1>

        <!-- Start Category Management -->

        <div class="border-b border-b-gray-500/60 mb-8">
            <form
                v-if="showCategoryInput"
                class="p-2 bg-neutral-100 dark:bg-neutral-900 rounded-xl my-5"
                @submit.prevent="addCategory"
            >
                <div class="grid gap-4">
                    <Input
                        class="flex-1 xl:text-xl lg:text-lg outline-none ring-2 ring-ring ring-offset-2"
                        v-model="category_content"
                        autofocus
                    />

                    <div class="flex flex-row justify-end gap-4">
                        <Button type="submit">Save</Button>
                        <Button
                            type="cancel"
                            variant="secondary"
                            @click="cancelCategory"
                            >Cancel</Button
                        >
                    </div>
                </div>
            </form>

            <div v-else class="flex flex-row py-3 justify-between">
                <div class="flex flex-row gap-2">
                    <div
                        class="w-14 border border-black dark:border-white rounded-sm flex items-center justify-center"
                    >
                        <h4 class="font-[Caladea]">CCSM</h4>
                    </div>
                    <div
                        class="w-14 border border-black dark:border-white rounded-sm flex items-center justify-center"
                    >
                        <h4 class="font-[Caladea]">DBMS</h4>
                    </div>
                    <div
                        class="w-14 border border-black dark:border-white rounded-sm flex items-center justify-center"
                    >
                        <h4 class="font-[Caladea]">DW</h4>
                    </div>
                </div>

                <button
                    @click="toggleCategoryInput"
                    class="bg-black dark:bg-white rounded-full flex items-center justify-center px-1 shadow-xl mr-5"
                >
                    <span
                        class="material-symbols-outlined text-white dark:text-black text-xl"
                    >
                        add
                    </span>
                </button>
            </div>
        </div>

        <!-- End Category Management -->

        <!-- Start Task Management -->
        <div
            v-if="auth.user"
            v-for="(todo, index) in tasks"
            class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-4"
        >
            <Checkbox
                :checked="todo.done"
                @update:checked="
                    (checked) => handleCheckboxChange(index, checked)
                "
            />
            <Input
                type="text"
                class="flex-1 border-none h-6 font-asap xl:text-xl lg:text-lg text-base px-1"
                v-model="todo.content"
            />
            <div class="actions">
                <button
                    class="delete xl:text-base text-xs"
                    @click="removeTodo(todo)"
                >
                    Delete
                </button>
            </div>
        </div>

        <div
            v-else
            v-for="(todo, index) in todos_asc"
            class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-4"
        >
            <Checkbox
                :checked="todo.done"
                @update:checked="
                    (checked) => handleCheckboxChange(index, checked)
                "
            />
            <Input
                type="text"
                class="flex-1 border-none h-6 font-asap xl:text-xl lg:text-lg text-base px-1"
                v-model="todo.content"
            />
            <div class="actions">
                <button
                    class="delete xl:text-base text-xs"
                    @click="removeTodo(todo)"
                >
                    Delete
                </button>
            </div>
        </div>
        <!-- End Task Management -->

        <!-- Add New Task Form -->
        <form
            v-if="showTaskInput"
            class="p-2 bg-neutral-100 dark:bg-neutral-900 rounded-xl"
            @submit.prevent="addTodo"
        >
            <div class="grid gap-4">
                <Input
                    class="flex-1 xl:text-xl lg:text-lg outline-none ring-2 ring-ring ring-offset-2"
                    v-model="task_content"
                    autofocus
                />

                <div class="flex flex-row justify-end gap-4">
                    <Button type="submit">Save</Button>
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
            @click="toggleTaskInput"
            class="w-full flex items-center h-12 xl:text-xl lg:text-lg font-asap text-black border-2 border-dashed border-spacing border-[#B3AEAE]/50 bg-[#FFFBFF] hover:bg-neutral-50 dark:text-white dark:bg-[#2f2929]/50 dark:hover:bg-[#2f2929]/40 dark:border-[#D3D3D3]/50"
        >
            Add new task
            <span class="material-symbols-outlined"> add </span>
        </Button>
    </div>
</template>

<style>
.border-spacing {
    border-spacing: 10px;
}
</style>
