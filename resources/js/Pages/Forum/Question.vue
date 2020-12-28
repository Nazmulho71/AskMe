<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ que.title }}
            </h2>
        </template>

        <div class="py-12 pb-6">
            <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
                <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="flex flex-col justify-between mb-2 sm:flex-row">
                        <div class="mb-2">
                            <p class="text-gray-400 text-sm">
                                {{ que.user.name }} asked {{ que.time_diff }}
                            </p>
                        </div>

                        <div>
                            <span class="text-red-500">{{ que.reply_count }}</span>
                        </div>
                    </div>
                    
                    <hr class="mb-3 border-gray-200">

                    <div>
                        <p>{{ que.body }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
                <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div v-if="question.replies_count">
                        <replies v-for="reply in reps" :question=que :data=reply :key=reply.id />
                    </div>

                    <div v-else>
                        <p class="text-gray-500">No answers found yet! <a class="text-red-500 underline transition-all duration-100 hover:text-red-300" href="#">Write an answer</a></p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Replies from '@/Pages/Forum/Replies'

    export default {
        props: ['question', 'replies'],

        data() {
            return {
                que: this.question,
                reps: this.replies
            }
        },

        components: {
            AppLayout,
            Replies
        }
    }
</script>