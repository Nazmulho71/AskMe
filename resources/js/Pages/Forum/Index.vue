<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Forum
            </h2>
        </template>

        <div class="py-12">
            <questions />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Questions from '@/Pages/Forum/Questions'

    export default {
        components: {
            AppLayout,
            Questions,
        },
    }
</script>