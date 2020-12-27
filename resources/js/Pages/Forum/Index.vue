<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Discussions
            </h2>
        </template>

        <div class="py-12">
            <questions v-for="question in ques" :data=question :key=question.id />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Questions from '@/Pages/Forum/Questions'

    export default {
        props: ['questions'],

        data() {
            return {
                ques: this.questions
            };
        },

        components: {
            AppLayout,
            Questions,
        }
    }
</script>