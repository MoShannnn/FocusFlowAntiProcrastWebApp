<script setup>
import Button from "./ui/button/Button.vue";
import Input from "./ui/input/Input.vue";

import Separator from "./ui/separator/Separator.vue";

import { ref } from "vue";
import { useForm, Link, usePage } from "@inertiajs/vue3";

const { props } = usePage();
const auth = props.auth;

//Form
const form = useForm({
    name: auth.user.name,
    email: auth.user.email,
});

const errors = ref({});

const submit = () => {
    form.post("/update-profile", {
        onError: (error) => {
            errors.value = error;
        },
        onSuccess: () => {
            alert('Successfully Updated'); 
        },
    });
};
</script>

<template>
    <div>
        <h3 class="text-lg font-medium">Profile</h3>
        <p class="text-sm text-muted-foreground">
            This is how others will see you on the site.
        </p>
    </div>
    <Separator />
    <form class="space-y-8" @submit.prevent="submit">
        <div class="grid gap-2">
            <Label for="username">Username</Label>
            <Input
                id="name"
                required
                autocomplete="false"
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
                required
                v-model="form.email"
                :class="{ 'is-invalid': errors.email }"
            />
            <span v-if="errors.email">{{ errors.email }}</span>
        </div>

        <div class="flex gap-2 justify-start">
            <Button type="submit"> Update profile </Button>

            <Button type="button" variant="outline" @click="form.reset()">
                Reset form
            </Button>
        </div>
    </form>
</template>
