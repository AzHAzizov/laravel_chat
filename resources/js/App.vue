<template>
    <div>
        
      <h1 class="text-3xl font-bold underline">
        Hello world!
      </h1>

        <router-link to="/">Main page</router-link>
        <router-link to="about">About page</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>

</style>