<template>
    <div class="container">
        <all-posts></all-posts>
    </div>
</template>

<script>

import AllPosts from "./Post/AllPosts";

export default {
    name: "Home",
    components: {
        AllPosts,
    }
}
</script>

<style scoped>

</style>
