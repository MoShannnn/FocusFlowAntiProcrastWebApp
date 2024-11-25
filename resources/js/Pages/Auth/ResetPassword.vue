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
    password_previous: "",
    password: "",
    password_confirmation: "",
});

const errors = ref({});

const submit = () => {
    form.post("/reset-password", {
        onError: (errors) => {
          if (errors.password_previous) {
            alert(errors.password_previous); // Handle incorrect password message
          }
        },
    });
};
</script>

<template>

    <div class="flex relative items-center justify-center w-screen h-screen gap-10">
        <Button class="absolute top-10 left-12">
            <Link href="/"> <i class="bi bi-arrow-left me-2"></i>Home</Link>
        </Button>
        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-xl">Change Password </CardTitle>
                <CardDescription>
                    Enter your previous password to change a new one
                </CardDescription>
            </CardHeader>
            <form @submit.prevent="submit">
                <CardContent>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="password">Previous Password</Label>
                            <Input
                                id="password_previous"
                                type="password"
                                v-model="form.password_previous"
                                :class="{ 'is-invalid': errors.password_previous }"
                            />
                            <span v-if="errors.password">{{
                                errors.password
                            }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                :class="{ 'is-invalid': errors.password }"
                            />
                            <span v-if="errors.password">{{
                                errors.password
                            }}</span>
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
                            Change Password
                        </Button>
                    </div>
                </CardContent>
            </form>
        </Card>
    </div>
</template>
