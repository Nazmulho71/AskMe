<template>
    <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
        <div class="py-4 px-6 bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="flex flex-col justify-between mb-2 sm:flex-row">
                <div class="mb-2">
                    <h3 class="text-lg font-semibold">
                        <inertia-link :href="route('question.show', data.slug)">
                            <b>{{ data.title }}</b>
                        </inertia-link>
                    </h3>

                    <p class="text-gray-400 text-sm">
                        <inertia-link class="underline transition-all duration-100 hover:text-gray-300" :href="route('dashboard', data.user)">{{ data.user.name }}</inertia-link> asked {{ data.time_diff }}
                    </p>
                </div>

                <div>
                    <span class="text-red-500">{{ data.reply_count }}</span>
                </div>
            </div>
            
            <hr class="mb-3 border-gray-200">

            <div>
                <p v-html="body_excerpt"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import md from 'marked'

    export default {
        props: ['data'],

        computed: {
            body_excerpt() {
                return md.parse(this.data.body_excerpt);
            }
        }
    }
</script>