<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Replying to: <b>{{ que.title }}</b>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-4 px-6">
                        <form method="post" @submit.prevent="createAnswer">
                            <div>
                                <label class="block mb-2 font-medium text-gray-700" for="title">
                                    <span>Write your answer</span>
                                </label>

                                <textarea rows="6" class="form-input rounded-md shadow-sm mt-1 block w-full" name="body" v-model="form.body" v-bind:class="{'border-red-500': checkErrors.body}"></textarea>

                                <div class="text-red-500 text-sm mt-1" v-if="errors.body">
                                    {{ errors.body[0] }}
                                </div>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    <inertia-link class="text-red-500 underline transition-all duration-100 hover:text-red-300" :href="route('question.show', que.slug)">
                                        Go Back
                                    </inertia-link>
                                </div>

                                <div>
                                    <jet-button type="submit">
                                        Answer
                                    </jet-button>
                                </div>
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
                que: this.question,

                form: {
                    body: ''
                },

                errors: {
                    body: []
                },

                checkErrors: {
                    body: false
                }
            }
        },

        components: {
            AppLayout,
            JetButton
        },

        methods: {
            createAnswer() {
                axios.post('/question/' + this.que.slug + '/reply', this.form)
                    .then(response => {
                        this.checkErrors = {
                            body: (this.errors.body == true) ?? false
                        };

                        this.errors = { body: [] };

                        this.$inertia.visit('/question/' + this.que.slug, { method: 'get' });
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;

                        this.checkErrors = {
                            body: (this.errors.body) ? true : false
                        };
                    });
            }
        }
    };
</script>
