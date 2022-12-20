<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">Welcome to Simvel!</h1>
                <p class="py-6">
                    A simple Laravel CRUD Application. As for now we only have
                    Todo CRUD Sample.
                </p>
                <Link :href="route('todos')">
                    <button class="btn btn-primary">Get Started</button>
                </Link>
            </div>
        </div>
    </div>
</template>
