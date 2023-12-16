<template>
    <div class="flex justify-between mb-7">
        <div>Subscribers: {{ stats.subscribers_count }}</div>
        <div>Likes {{ stats.likes_count }}</div>
        <div>Posts {{ stats.posts_count }}</div>
        <div>Followings {{ stats.followings_count }}</div>
    </div>
</template>

<script>
export default {

    name: "Stat",
    props: [
        'stats'
    ],
    setup() {

        return {}
    }
}
</script>

<style lang="scss" scoped>

</style>