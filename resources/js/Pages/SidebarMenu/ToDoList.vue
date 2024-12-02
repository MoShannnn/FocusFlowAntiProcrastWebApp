<script setup>
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Button } from "../../components/ui/button/index";
import { ScrollArea, ScrollBar } from "@/components/ui/scroll-area";

import { ref, onMounted, computed, watch } from "vue";

import { useForm, usePage } from "@inertiajs/vue3";

const { props } = usePage();
const auth = props.auth;

const categories = ref([]);
const tasks = ref([]);

const todos = ref([]);
const errors = ref({});

const showCategoryInput = ref(false);
const showTaskInput = ref(false);

const category_content = ref("");
const task_content = ref("");
const task_category = ref("");

const activeCategoryId = ref(null);
const rightClickedCategoryId = ref(null);

const filteredTasks = computed(() => {
    if (!activeCategoryId.value) {
        return tasks.value; // Show all tasks if no category is selected
    }
    return tasks.value.filter(
        (task) => task.category_id === activeCategoryId.value
    );
});

function selectCategory(categoryId) {
    activeCategoryId.value = categoryId;
}

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

const handleTaskCheckboxChange = (index, checked) => {
    const todo = tasks.value[index]; // Access the specific task being updated

    // Prepare form with updated status based on checkbox state
    const form = useForm({
        name: todo.name,
        category_id: todo.category_id, // Ensure category_id is preserved
        status: checked ? 1 : 0, // Set status to 1 if checked, 0 otherwise
    });

    form.put(`/tasks/${todo.id}`, {
        onSuccess: (response) => {
            tasks.value = response.props.tasks; // Refresh the tasks list
        },
        onError: (error) => {
            errors.value = error; // Handle errors
        },
    });
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

// Method to update tasks
const updateTask = (todo) => {
    const form = useForm({
        name: todo.name,
        status: 0,
    });
    form.put(`/tasks/${todo.id}`, {
        onSuccess: (response) => {
            tasks.value = response.props.tasks;
        },
        onError: (error) => {
            errors.value = error;
        },
    });
};

const addCategory = () => {
    if (category_content.value.trim() === "") {
        alert("Please fill out the category name");
        return;
    }

    if (auth.user) {
        //Form
        const form = useForm({
            name: category_content.value,
        });

        form.post("/categories", {
            onSuccess: (response) => {
                categories.value = response.props.categories; // Update with fresh data
            },
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
        alert("Please fill out the task name");
        return;
    }

    if (auth.user) {
        console.log(task_category.value);
        //Form
        const form = useForm({
            name: task_content.value,
            category_id: task_category.value,
            status: 0,
        });

        form.post("/tasks", {
            onSuccess: (response) => {
                tasks.value = response.props.tasks; // Update with fresh data
            },
            onError: (error) => {
                errors.value = error;
            },
        });
    } else {
        todos.value.push({
            content: task_content.value,
            done: false,
            editable: false,
            createdAt: new Date().getTime(),
        });
    }

    task_content.value = "";
    task_category.value = "";
};

const cancelCategory = () => {
    category_content.value = "";
    showCategoryInput.value = false;
};

const cancelTask = () => {
    task_content.value = "";
    task_category.value = "";
    showTaskInput.value = false;
};

const removeTodo = (todo) => {
    if (auth.user) {
        const form = useForm({});
        form.delete(`tasks/${todo}`, {
            onSuccess: (response) => {
                tasks.value = response.props.tasks;
            },
            onError: (error) => {
                errors.value = error;
            },
        });
    }

    todos.value = todos.value.filter((t) => t !== todo);
};

// Remove Category
const showDeleteIcon = (categoryId, event) => {
    rightClickedCategoryId.value = categoryId;

    setTimeout(() => {
        rightClickedCategoryId.value = null;
    }, 3000);
};

const deleteCategory = (id) => {
    if (confirm("Are you sure you want to delete this category?")) {
        const form = useForm({});
        form.delete(`categories/${id}`, {
            onSuccess: (response) => {
                categories.value = response.props.categories;
            },
            onError: (error) => {
                errors.value = error;
            },
        });
    }
    rightClickedCategoryId.value = null; 
};

onMounted(() => {
    todos.value = JSON.parse(localStorage.getItem("todos")) || [];
    categories.value = props.categories || [];
    tasks.value = props.tasks || [];
});
</script>

<template>
    <div class="w-full absolute left-0 bottom-0 h-[90vh] px-10">
        <h1 class="font-asap xl:text-3xl lg:text-2xl text-lg font-bold">
            Tasks
        </h1>

        <!-- For Registered User -->
        <div v-if="auth.user" class="mb-2">
            <!-- Start Category Management -->
            <div class="border-b border-b-gray-500/60 mb-4">
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
                            maxlength="4"
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

                <div
                    v-else
                    class="flex flex-row py-3 justify-between items-center"
                >
                    <ScrollArea class="w-10/12 py-4">
                        <div class="flex flex-row gap-2">
                            <div
                                class="w-14 border rounded-sm flex items-center justify-center cursor-pointer"
                                :class="{
                                    'border-2 border-[#A24BF4]':
                                        !activeCategoryId,
                                    'border-black dark:border-white':
                                        activeCategoryId,
                                }"
                                @click="selectCategory(null)"
                            >
                                <h4 class="font-[Caladea]">All</h4>
                            </div>
                            <div
                                v-for="category in categories"
                                :key="category.id"
                                class="relative w-14 border rounded-sm flex items-center justify-center cursor-pointer"
                                :class="{
                                    'border-2 border-[#A24BF4]':
                                        category.id === activeCategoryId,
                                    'border-black dark:border-white':
                                        category.id !== activeCategoryId,
                                }"
                                @click="selectCategory(category.id)"
                                @contextmenu.prevent="
                                    showDeleteIcon(category.id)
                                "
                            >
                                <h4 class="font-[Caladea]">
                                    {{ category.name }}
                                </h4>

                                <!-- Trash Bin -->
                                <div
                                    v-if="
                                        rightClickedCategoryId === category.id
                                    "
                                    class="absolute trash-bin flex items-center justify-center bg-white shadow-lg rounded border-2 border-red-400 px-5 cursor-pointer"
                                    @click="deleteCategory(category.id)"
                                >
                                    <span class="text-red-600"
                                        ><i class="bi bi-trash"></i
                                    ></span>
                                </div>
                            </div>
                        </div>
                        <ScrollBar orientation="horizontal" />
                    </ScrollArea>
                    <button
                        @click="toggleCategoryInput"
                        class="bg-black dark:bg-white rounded-full flex items-center justify-center px-1 h-8 w-8 shadow-xl mr-5"
                    >
                        <span
                            class="material-symbols-outlined text-white dark:text-black text-xl"
                        >
                            add
                        </span>
                    </button>
                </div>
            </div>

            <!-- Start Task Management -->
            <ScrollArea
                :class="{ 'h-[58vh]': tasks.length > 8 }"
                class="rounded-md"
            >
                <div
                    v-for="(todo, index) in filteredTasks"
                    :key="todo.id"
                    class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-2"
                >
                    <Checkbox
                        :checked="todo.status === 1"
                        @update:checked="
                            (checked) =>
                                handleTaskCheckboxChange(index, checked)
                        "
                    />
                    <Input
                        type="text"
                        class="flex-1 border-none h-6 font-asap xl:text-xl lg:text-lg text-base px-1"
                        v-model="todo.name"
                        maxlength="20"
                        @input="updateTask(todo)"
                    />
                    <div class="actions">
                        <button
                            class="delete xl:text-base text-xs"
                            @click="removeTodo(todo.id)"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </ScrollArea>
        </div>

        <!-- For Normal User -->
        <ScrollArea
            v-else
            :class="{ 'h-[72vh]': todos.length > 8 }"
            class="rounded-md mb-2"
        >
            <div class="mt-5">
                <div
                    v-for="(todo, index) in todos_asc"
                    class="flex flex-row gap-4 items-center border border-[#D3D3D3] rounded-lg px-4 py-3 mb-2"
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
            </div>
        </ScrollArea>

        <!-- Add New Box and form for both Register and Unregister-->
        <form
            v-if="showTaskInput"
            class="p-2 bg-neutral-100 dark:bg-neutral-900 rounded-xl"
            @submit.prevent="addTodo"
        >
            <div class="grid gap-4">
                <!-- Task content input -->
                <Input
                    class="flex-1 xl:text-xl lg:text-lg outline-none ring-2 ring-ring ring-offset-2"
                    v-model="task_content"
                    autofocus
                    maxlength="20"
                />

                <div v-if="auth.user" class="flex justify-between gap-4">
                    <select
                        v-model="task_category"
                        class="rounded-md w-1/2 px-2 dark:text-white dark:bg-black border border-slate-400"
                    >
                        <option disabled value="">Select a category</option>
                        <option
                            v-for="category in categories"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>

                    <!-- Action buttons -->
                    <div class="flex flex-row justify-end gap-4">
                        <Button
                            type="button"
                            variant="secondary"
                            @click="cancelTask"
                        >
                            Cancel
                        </Button>
                        <Button type="submit">Save</Button>
                    </div>
                </div>

                <div v-else class="flex flex-row justify-end gap-4">
                    <Button
                        type="button"
                        variant="secondary"
                        @click="cancelTask"
                    >
                        Cancel
                    </Button>
                    <Button type="submit">Save</Button>
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

.trash-bin {
    position: absolute;
    top: 50%; /* Vertically align with the category */
    transform: translateY(-50%); /* Center it vertically */
    z-index: 10; /* Ensure it's above other elements */
}
</style>
