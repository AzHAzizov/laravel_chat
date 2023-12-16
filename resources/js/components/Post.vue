<template>
    <div class="mb-8 pb-8 border-b border-gray-400">



        <h1 class="text-center mb-2"> {{ post.title }} </h1>

        <router-link :to="{ name: 'user.show', params: { id: post.user.id } }">
            {{ post.user.name }}
        </router-link>

        <img v-if="post.url" :src="post.url" :alt="post.title">
        <p class="break-all">{{ post.content }}</p>



        <div v-if="post.reposted_post" class="ml-4 p-2 bg-gray-100 border border-gray-200">



            <router-link :to="{ name: 'user.show', params: { id: post.reposted_post.user.id } }">
                {{ post.reposted_post.user.name }}
            </router-link>
            

            <h1 class="text-center mb-2"> {{ post.reposted_post.title }} </h1>
            <img v-if="post.reposted_post.url" :src="post.reposted_post.url" :alt="post.reposted_post.title">
            <p class="break-all">{{ post.reposted_post.content }}</p>
        </div>

        <div class="flex justify-between items-center">
            <div class="flex">
                <div class="flex mr-3">
                    <svg @click.prevent="toggleLike(post)" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="getLikeButtonStyle(post)">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <p>
                        {{ post.likes_count }}
                    </p>
                </div>

                <div class="flex">
                    <svg @click.prevent="toggleRepostField()" xmlns="http://www.w3.org/2000/svg"
                        :class="getShareButtonStyle()" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                    </svg>
                    <p>{{ post.reposted_by_posts_count }}</p>
                </div>
            </div>
            <p class="text-right text-slate-500 text-sm">{{ post.date }}</p>
        </div>
        <div class="mt-5" v-if="repostFieldVisibility">
            <div class=" mb-3">
                <input v-model="title" class="w-96 rounded-3xl border p-2 border-slate-300" type="text"
                    placeholder="Your comment here...">
                <!-- <div v-if="errors.title">
                                <p v-for="error in errors.title" class="text-sm mt-2 text-red-500">{{ error }}</p>
                            </div> -->
            </div>
            <div class=" mb-3">
                <textarea v-model="content" class="w-96 rounded-3xl border p-2 border-slate-300"
                    placeholder="content"></textarea>
            </div>
            <div>
                <a @click.prevent="repost(post)" href="#" class="block p-2 w-32 text-center rounded-3xl bg-green-600 text-white
                hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border ml-auto">Repost</a>
            </div>
        </div>

        <div v-if="post.comments_count > 0">
            <p v-if="!commentsShow" @click="getComments(post)" class="cursor-pointer">Show {{ post.comments_count }}
                comments</p>
            <p class="cursor-pointer" v-else @click.prevent="commentsShow = false"> Close </p>

            <div v-if="comments && commentsShow">
                <div v-for="comment in comments" :key="comment.id" class="shadow-lg p-3 my-3 ml-2">


                    <div class="flex">
                        <p class="text-sm mr-2">{{ comment.user.name }}</p>
                        <p @click="setParentId(comment)" class="cursor-pointer text-sm text-sky-500">Answer</p>
                    </div>

                    <p>
                        <span v-if="comment.answered_for_user" class="text-green-500">
                            {{ comment.answered_for_user }}
                        </span> {{ comment.body }}
                    </p>
                    <p class="text-right">{{ comment.date }}</p>
                </div>
            </div>



        </div>

        <div>
            <div class=" mb-3">



                <div class="flex items-center">
                    <p v-if="answeredComment" class="mr-2">Answered for {{ answeredComment.user.name }}</p>
                    <p v-if="answeredComment" @click="answeredComment = false" class="cursor-pointer text-red-500 text-sm">
                        Cancel</p>
                </div>

                <input v-model="comment" class="w-96 rounded-3xl border p-2 border-slate-300" type="text"
                    placeholder="title">
            </div>
            <div>
                <a @click.prevent="storeComment(post)" href="#" class="block p-2 w-32 text-center rounded-3xl bg-green-600 text-white
                hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border ml-auto">Comment</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",

    props: [
        'post'
    ],

    data() {
        return {
            repostFieldVisibility: false,
            title: "",
            content: "",
            body: "",
            comment: "",
            comments: [],
            commentsShow: false,
            parentId: false,
            answeredComment: null,
        }
    },



    methods: {


        setParentId(comment) {
            this.answeredComment = comment
        },


        getLikeButtonStyle(post) {
            if (post.is_liked) return 'fill-sky-500  curser-pointer hover:fill-white w-6 h-6';
            return 'fill-white stroke-sky-500  curser-pointer hover:fill-sky-500 w-6 h-6';
        },
        getShareButtonStyle() {
            return 'fill-sky-500  curser-pointer hover:fill-white w-6 h-6';
        },

        storeComment(post) {
            axios.post(`/api/post/${post.id}/comment`, {
                body: this.comment,
                parent_id: this.answeredComment.id
            })
                .then(res => {
                    this.commentsShow = true;
                    this.answeredComment = null;
                    this.parentId = false,
                        post.comments_count++;
                    this.comment = ''
                    this.comments.unshift(res.data.data);
                })
        },
        getComments(post) {
            axios.get(`/api/post/${post.id}/comment-list`).then(res => {
                this.comments = res.data.data
                this.commentsShow = true
            })
        },
        toggleRepostField() {
            this.repostFieldVisibility = !this.repostFieldVisibility
        },

        toggleLike(post) {
            axios.get(`/api/post/${post.id}/toggle`)
                .then(res => {
                    post.is_liked = res.data.is_liked;
                    post.likes_count = res.data.likes_count;
                })
        },

        repost(post) {
            axios.post(`/api/post/${post.id}/repost`, {
                title: this.title,
                content: this.content
            }).then(() => {
                this.title = "";
                this.content = "";
                post.reposted_by_posts_count++
            }).catch(function () {

            });
        }
    }

}
</script>

<style scoped></style>