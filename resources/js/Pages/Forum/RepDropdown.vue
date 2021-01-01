<template>
    <jet-dropdown align="right" width="48">
        <template #trigger>
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </template>

        <template #content>
            <div>
                <jet-dropdown-link :data=data :key="data.id" :href="route('reply.edit', [question.slug, data.id])">
                    Update
                </jet-dropdown-link>

                <form @submit.prevent="destroy">
                    <jet-dropdown-link as="button">
                        Delete
                    </jet-dropdown-link>
                </form>
            </div>
        </template>
    </jet-dropdown>
</template>

<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {
        props: ['data', 'question'],

        components: {
            JetDropdown,
            JetDropdownLink
        },

        methods: {
            destroy() {
                axios.delete('/question/' + this.question.slug + '/reply/' + this.data.id)
                    .then(response => {
                        this.$inertia.visit('/question/' + this.question.slug, { method: 'get' });
                    })
                    .catch(e => console.log(e.resopnse.data));
            }
        }
    }
</script>