<template>
    <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
                <i class="bi bi-person-circle text-2xl text-zinc-600 dark:text-gray-300"></i>
                <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>My Account</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem @click="logout">Logout</DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
</template>

<script setup>
import { Button } from "@/components/ui/button";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'

import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
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
</script>
