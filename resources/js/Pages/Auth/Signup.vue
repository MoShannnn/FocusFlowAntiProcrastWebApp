<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

import { ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
//Form
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const errors = ref({});

const submit = () => {
    form.post("/signup", {
        onError: (error) => {
            errors.value = error;
        },
    });
};
</script>

<template>
    <div class="flex items-center justify-center w-screen h-screen">
        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-xl"> Sign Up </CardTitle>
                <CardDescription>
                    Enter your information to create an account
                </CardDescription>
            </CardHeader>
            <form @submit.prevent="submit">
                <CardContent>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="username">Username</Label>
                            <Input
                                id="username"
                                placeholder="Max"
                                required
                                autocomplete="false"
                                autofocus
                                v-model="form.name"
                                :class="{ 'is-invalid': errors.name }"
                            />
                            <span v-if="errors.name">{{ errors.name }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                placeholder="m@example.com"
                                required
                                v-model="form.email"
                                :class="{ 'is-invalid': errors.email }"
                            />
                            <span v-if="errors.email">{{ errors.email }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                :class="{ 'is-invalid': errors.password }"
                            />
                            <span v-if="errors.password">{{errors.password}}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="password_confirmation"
                                >Password Confirm</Label
                            >
                            <Input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                :class="{
                                    'is-invalid': errors.password_confirmation,
                                }"
                            />
                            <span v-if="errors.password_confirmation">{{
                                errors.password_confirmation
                            }}</span>
                        </div>
                        <Button type="submit" class="w-full">
                            Create an account
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Already have an account?
                        <Link href="/login" class="underline"> Sign in </Link>
                    </div>
                </CardContent>
            </form>
        </Card>
    </div>
</template>
