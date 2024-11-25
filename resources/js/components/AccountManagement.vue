<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
                <i
                    class="bi bi-person-circle text-2xl text-zinc-600 dark:text-gray-300"
                ></i>
                <span class="sr-only">Toggle user menu</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56" align="end">
            <DropdownMenuLabel>
                <div class="flex flex-col space-y-1">
                    <p class="text-sm font-medium leading-none">
                        {{ auth.user ? auth.user.name : "My Account" }}
                    </p>
                    <p class="text-xs leading-none text-muted-foreground">
                        {{ auth.user ? auth.user.email : " " }}
                    </p>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />

            <div v-if="auth.user">
                <Link href="/settings">
                    <DropdownMenuItem>Settings </DropdownMenuItem>
                </Link>
                <DropdownMenuSeparator />
                <DropdownMenuItem @click="logout">Logout</DropdownMenuItem>
            </div>
            <Link v-else href="/login">
                <DropdownMenuItem> Login </DropdownMenuItem>
            </Link>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<script setup>
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

import { ref } from "vue";
import { useForm, Link, usePage } from "@inertiajs/vue3";
//Form
const form = useForm({});

const errors = ref({});

const logout = () => {
    form.post("/logout", {
        onError: (error) => {
            errors.value = error;
        },
    });
};

const { props } = usePage();
const auth = props.auth;
</script>
