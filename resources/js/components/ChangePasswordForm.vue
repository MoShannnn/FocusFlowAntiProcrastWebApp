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
import Separator from "./ui/separator/Separator.vue";

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
    <div>
        <h3 class="text-lg font-medium">Change Password</h3>
        <p class="text-sm text-muted-foreground">
            This is how you can change your password.
        </p>
    </div>
    <Separator />
    <form class="space-y-8" @submit.prevent="submit">
        <div class="grid gap-4">
            <div class="grid gap-2">
                <Label for="password">Previous Password</Label>
                <Input
                    id="password_previous"
                    type="password"
                    v-model="form.password_previous"
                    :class="{ 'is-invalid': errors.password_previous }"
                />
                <span v-if="errors.password">{{ errors.password }}</span>
            </div>
            <div class="grid gap-2">
                <Label for="password">Password</Label>
                <Input
                    id="password"
                    type="password"
                    v-model="form.password"
                    :class="{ 'is-invalid': errors.password }"
                />
                <span v-if="errors.password">{{ errors.password }}</span>
            </div>
            <div class="grid gap-2">
                <Label for="password_confirmation">Password Confirm</Label>
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
            <div class="flex gap-2 justify-start">
                <Button type="submit"> Update profile </Button>

                <Button type="button" variant="outline" @click="form.reset()">
                    Reset form
                </Button>
            </div>
        </div>
    </form>
</template>
