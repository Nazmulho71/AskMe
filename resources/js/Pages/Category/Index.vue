<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ cate.name }}
                    </h2>
                </div>

                <div>
                    <inertia-link class="text-red-500 underline transition-all duration-100 hover:text-red-300" :href="route('category.que.create', cate.slug)">
                        Ask under this category
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div>
                <questions v-for="question in ques" :data=question :key=question.id />
            </div>

            <div v-if="ques.q_counts == 0">
                <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
                    <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                        <p class="text-gray-500">No questions found yet! <inertia-link class="text-red-500 underline transition-all duration-100 hover:text-red-300" :href="route('category.que.create', cate.slug)">Ask a question</inertia-link></p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Questions from '@/Pages/Category/Questions'

    export default {
        props: ['questions', 'category'],

        data() {
            return {
                ques: this.questions,
                cate: this.category
            };
        },

        components: {
            AppLayout,
            Questions
        }
    }
</script>
