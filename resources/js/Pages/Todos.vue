<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { onMounted, reactive } from "@vue/runtime-core";
import axios from "axios";

const state = reactive({
    todos: [],
    todo: {
        title: "",
        description: "",
    },
    modal: {},
});
async function createTodo(todo) {
    if (confirm("Are you sure you want to add " + todo.title + "?")) {
        await axios.post("api/todos", todo);
        window.location.reload();
    }
}
function passTodoToModal(todo) {
    state.modal = {
        ...todo,
    };
}
async function updateTodo(todo) {
    await axios.put("api/todos/" + todo.id, todo);
    window.location.reload();
}
async function deleteTodo(todo) {
    if (confirm("Are you sure you want to delete " + todo.title + "?")) {
        await axios.delete("api/todos/" + todo.id);
        window.location.reload();
    }
}
onMounted(async () => {
    await axios.get("api/todos").then((res) => {
        state.todos = res.data;
    });
});
</script>

<template>
    <Head title="Todos" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="navbar bg-white">
                        <a class="btn btn-ghost normal-case text-5xl">Todos</a>
                    </div>
                    <div class="flex mb-5">
                        <input
                            type="text"
                            v-model="state.todo.title"
                            placeholder="Title"
                            class="input input-bordered w-full max-w-xs mr-2"
                        />
                        <input
                            type="text"
                            v-model="state.todo.description"
                            placeholder="Description"
                            class="input input-bordered w-full max-w-xs mx-2"
                        />
                        <button
                            class="btn btn-circle btn-primary ml-2"
                            @click.prevent="createTodo(state.todo)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    fill="#000000"
                                    d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-x-auto w-full">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="todo in state.todos" :key="todo.id">
                                    <td>
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <div>
                                                <div class="font-bold">
                                                    {{ todo.title }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ todo.description }}</td>
                                    <th>
                                        <label
                                            for="edit-modal"
                                            class="btn btn-ghost btn-xs modal-button"
                                            @click="passTodoToModal(todo)"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill="#000000"
                                                    d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z"
                                                />
                                            </svg>
                                        </label>
                                        <button
                                            class="btn btn-ghost btn-xs"
                                            @click.prevent="deleteTodo(todo)"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill="#000000"
                                                    d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"
                                                />
                                            </svg>
                                        </button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input
                        type="checkbox"
                        id="edit-modal"
                        class="modal-toggle"
                    />
                    <div class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Update Todo</h3>
                            <p class="py-4">
                                Feel free to edit todo data below:
                            </p>
                            <div class="flex m-5">
                                <input
                                    type="text"
                                    v-model="state.modal.title"
                                    placeholder="Title"
                                    class="input input-bordered w-full max-w-xs mr-2"
                                />
                                <input
                                    type="text"
                                    v-model="state.modal.description"
                                    placeholder="Description"
                                    class="input input-bordered w-full max-w-xs mx-2"
                                />
                            </div>

                            <div class="modal-action">
                                <label
                                    for="edit-modal"
                                    class="btn btn-primary"
                                    @click.prevent="updateTodo(state.modal)"
                                    >Update</label
                                >
                                <label
                                    for="edit-modal"
                                    class="btn btn-secondary"
                                    >Cancel</label
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
