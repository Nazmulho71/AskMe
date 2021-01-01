<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update: <b>{{ question.title }}</b>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-4 px-6">
                        <form method="post" @submit.prevent="updateQuestion">
                            <div>
                                <label class="block mb-2 font-medium text-sm text-gray-700" for="title">
                                    <span>Question Title</span>
                                </label>

                                <input v-model="form.title" class="form-input rounded-md shadow-sm mt-1 block w-full" v-bind:class="{'border-red-500': checkErrors.title}" name="title" id="title" type="text" autocomplete="off">

                                <div class="text-red-500 text-sm mt-1" v-if="errors.title">
                                    {{ errors.title[0] }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block mb-2 font-medium text-sm text-gray-700" for="title">
                                    <span>Description</span>
                                </label>

                                <vue-simplemde name="body" v-model="form.body" v-bind:class="{'border-red-500': checkErrors.body}"></vue-simplemde>

                                <div class="text-red-500 text-sm -mt-4 mb-4" v-if="errors.body">
                                    {{ errors.body[0] }}
                                </div>
                            </div>

                            <div>
                                <jet-button type="submit">
                                    Update
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import JetButton from '@/Jetstream/Button';
    import { Inertia } from '@inertiajs/inertia';

    export default {
        props: ['question'],

        data() {
            return {
                form: {
                    title: this.question.title,
                    category: this.question.category_id,
                    body: this.question.body
                },

                errors: {
                    title: [],
                    category: [],
                    body: []
                },

                checkErrors: {
                    title: false,
                    category: false,
                    body: false
                }
            }
        },

        components: {
            AppLayout,
            JetButton
        },

        methods: {
            updateQuestion() {
                axios.put('/question/' + this.question.slug + '/edit', this.form)
                    .then(response => {
                        this.checkErrors = {
                            title: false,
                            category: false,
                            body: false
                        };
                        
                        this.errors = {
                            title: [],
                            body: [],
                            category: []
                        };

                        this.$inertia.visit('/question/' + slugify(this.form.title.toLowerCase()), { method: 'get' });
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;

                        this.checkErrors = {
                            title: (this.errors.title) ? true : false,
                            category: (this.errors.category) ? true : false,
                            body: (this.errors.body) ? true : false
                        };
                    });
            }
        }
    };
</script>
