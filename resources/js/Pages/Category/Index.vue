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
            <questions v-for="question in ques" :data=question :key=question.id />
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
