<template>
    <div v-if="users" class="w-96 mx-auto">
        <div v-for="user in users" class="mb-8 flex items-center justify-between">
            <div>
                <router-link :to="{ name: 'user.show', params: { id: user.id } }">
                    <h1>
                        {{ user.name }}
                    </h1>
                </router-link>
            </div>
            <div>
                <a @click.prevent="toggleFollow(user)" :class="getFollowButton(user)">
                    <span v-if="user.is_followed">Unfollow</span>
                    <span v-else>Follow</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",

    data() {
        return {
            users: [],
        }
    },


    mounted() {
        this.getUsers()
    },

    methods: {
        getFollowButton(user) {
            if (user.is_followed) return 'bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded';
            return 'bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded';
        },


        toggleFollow(user) {
              axios.get(`/api/user/${user.id}/toggle`)
                .then(res => {
                    user.is_followed = res.data.is_followed;
                })
        },

        getUsers() {
            axios.get('/api/user/list').then(res => {
                this.users = res.data.data
            })
        }
    }
}
</script>

<style scoped></style>