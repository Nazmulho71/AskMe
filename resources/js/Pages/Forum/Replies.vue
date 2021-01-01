<template>
    <div class="py-4">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-400 text-sm inline-flex items-center overflow-visible">
                    <inertia-link class="underline transition-all duration-100 hover:text-gray-300" :href="route('dashboard', data.user)">{{ data.user.name }}</inertia-link> answered {{ data.time_diff }}
                    
                    <span v-if="data.isAuthReplied" class="ml-2">
                        <rep-dropdown :data="data" :question="que" :key="data.id" />
                    </span>
                </p>
            </div>

            <div class="text-lg">
                <span @click="interact">
                    <i :id="'heart' + data.id" :class="this.dynamicClass + ' text-red-600 cursor-pointer transition-all duration-100 transform hover:scale-90'"></i>
                </span>

                <span :id="'likesCount' + data.id" class="text-red-500">{{ data.likes_count }}</span>
            </div>
        </div>

        <div>
            <p>{{ data.body }}</p>
        </div>
    </div>
</template>

<script>
    import RepDropdown from '@/Pages/Forum/RepDropdown'

    export default {
        components: {
            RepDropdown
        },

        props: ['data', 'question'],

        data() {
            return {
                que: this.question,
                likeStatus: '',
                dynamicClass: ''
            }
        },

        created() {
            this.likeStatus = this.data.isLiked;
            this.dynamicClass = this.likeStatus ? 'fas fa-heart' : 'far fa-heart'
        },

        methods: {
            interact() {
                if (this.likeStatus) {
                    axios.delete('/reply/' + this.data.id + '/unlike', this.data.id)
                        .then(response => {
                            let span = document.getElementById('likesCount' + this.data.id);
                            let counts = span.innerText;

                            counts--;
                            span.innerText = counts;
        
                            let heart = document.getElementById('heart' + this.data.id);

                            heart.classList.remove('fas');
                            heart.classList.add('far');

                            this.likeStatus = false;
                        })
                        .catch(e => console.log(e.response.data));
                } else {
                    axios.post('/reply/' + this.data.id + '/like', this.data.id)
                        .then(response => {
                            let span = document.getElementById('likesCount' + this.data.id);
                            let counts = span.innerText;

                            counts++;
                            span.innerText = counts;

                            let heart = document.getElementById('heart' + this.data.id);

                            heart.classList.remove('far');
                            heart.classList.add('fas');

                            this.likeStatus = true;
                        })
                        .catch(e => console.log(e.response.data));
                }
            }
        }
    }
</script>