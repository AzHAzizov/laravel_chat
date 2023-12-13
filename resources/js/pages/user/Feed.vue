<template>
    <div class="w-96 mx-auto">
        <div v-if="posts">
            <div v-for="post in posts" class="shadow-md  mb-4 p-3 border-b border-gray-300">
                <Post :post="post" />
            </div>
        </div>
    </div>
</template>

<script>
import Post from "../../components/Post.vue";
// import Stat from "../../components/Stat.vue";
export default {
    name: "Feed",

    data() {
        return {
            posts: [],
        }
    },

    components: {
        Post,
        // Stat
    },

    mounted() {
        this.getPosts()
        // this.getStats()
    },

    methods: {
        getPosts() {
            axios.get(`/api/user/feed/post/list`)
                .then(res => {
                    this.posts = res.data.data
                })
        },
    }
}
</script>

<style scoped></style>