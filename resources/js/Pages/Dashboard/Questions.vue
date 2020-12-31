<template>
    <div class="flex flex-col justify-between sm:flex-row">
        <div class="mb-2">
            <h3 class="text-lg font-semibold">
                <inertia-link :href="route('question.show', data.slug)">
                    {{ data.title }}
                </inertia-link>
                
                <span class="text-gray-400 text-sm">
                    Asked in {{ data.category.name }} {{ data.time_diff }}
                </span>
            </h3>
        </div>

        <div>
            <span class="text-red-500 hidden sm:block">{{ data.reply_count }}</span>
        </div>
    </div>
</template>

<script>
    import md from 'marked'

    export default {
        props: ['data'],

        data() {
            return {
                question: this.data
            }
        },

        computed: {
            body_excerpt() {
                return md.parse(this.data.body_excerpt);
            }
        }
    }
</script>
