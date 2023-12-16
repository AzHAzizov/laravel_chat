<template>
    <div class="w-96 mx-auto">
        <Stat :stats="stats"></Stat>
        <div v-if="posts">
            <div v-for="post in posts" class="shadow-md  mb-4 p-3 border-b border-gray-300">
                <Post :post="post" />
            </div>
        </div>
    </div>
</template>

<script>
import Post from "../../components/Post.vue";
import Stat from "../../components/Stat.vue";
export default {
    name: "Show",

    data() {
        return {
            posts: [],
            user_id: this.$route.params.id,
            stats: null,
        }
    },

    components: {
        Post,
        Stat
    },

    mounted() {
        this.getPosts()
        this.getStats()
    },

    methods: {



        getStats() {
            axios.post('/api/user/stats', { user_id: this.user_id })
                .then(res => {
                    this.stats = res.data.data
                })
        },

        getPosts() {
            axios.get(`/api/user/${this.user_id}/posts`)
                .then(res => {


                    console.log(res.data.data);

                    this.posts = res.data.data
                })
        },
    }
}
</script>

<style scoped></style>