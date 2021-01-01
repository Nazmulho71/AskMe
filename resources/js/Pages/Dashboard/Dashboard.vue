<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="py-4 px-6 mb-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <img class="h-16 w-16 rounded-full object-cover" :src="user.profile_photo_url" :alt="user.name" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-2xl">{{ user.name }}</h3>
                                <span class="">{{ user.email }}</span>
                            </div>
                        </div>

                        <div class="text-right hidden sm:block">
                            <div class="text-red-500">{{ q_count }}</div>
                            <div class="text-red-500">{{ r_count }}</div>
                        </div>
                    </div>
                </div>

                <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <questions v-for="que in questions" :key="que.id" :data=que />

                    <div v-if="q_counts == 0">
                        <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
                            <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
                                <p class="text-gray-500">{{ user.name }} haven't asked anything yet!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Questions from '@/Pages/Dashboard/Questions'

    export default {
        props: ['user','questions', 'replies', 'q_count', 'r_count'],

        components: {
            AppLayout,
            Questions
        }
    }
</script>
