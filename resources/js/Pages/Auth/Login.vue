<script setup>
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
    email: "",
    password: "",
});

const errors = ref({});

const submit = () => {
    form.post("/login", {
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
                <CardTitle class="text-2xl"> Login </CardTitle>
                <CardDescription>
                    Enter your email below to login to your account
                </CardDescription>
            </CardHeader>
            <form @submit.prevent="submit">
                <CardContent>
                    <div class="grid gap-4">
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
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                                <!-- <a
                                    href="#"
                                    class="ml-auto inline-block text-sm underline"
                                >
                                    Forgot your password?
                                </a> -->
                            </div>
                            <Input
                                id="password"
                                type="password"
                                required
                                v-model="form.password"
                                :class="{ 'is-invalid': errors.password }"
                            />
                            <span v-if="errors.password">{{errors.password}}</span>
                        </div>
                        <Button type="submit" class="w-full"> Login </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Don't have an account?
                        <Link href="/signup" class="underline"> Sign up </Link>
                    </div>
                </CardContent>
            </form>
        </Card>
    </div>
</template>
