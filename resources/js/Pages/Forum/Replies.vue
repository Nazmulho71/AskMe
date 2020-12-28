<template>
    <div class="py-4">
        <div class="flex flex-col justify-between sm:flex-row">
            <div>
                <p class="text-gray-400 text-sm">
                    {{ data.user.name }} answered {{ data.time_diff }}
                </p>
            </div>

            <!-- <div>
                <span class="text-red-500">{{ data.reply_count }}</span>
            </div> -->
        </div>

        <div>
            <p>{{ data.body }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'question'],

        data() {
            return {
                que: this.question
            }
        }
    }
</script>