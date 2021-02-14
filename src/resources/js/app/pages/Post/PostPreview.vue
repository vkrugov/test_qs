<template>
    <div>
        <div class="row m1-2 post-preview">
            <div class="col-lg-6 text-left pt-1 pb-1">
                <router-link class="d-block" :to="{name: 'showPost', params: {post: post.id}}">
                    {{ post.title }}
                </router-link>
            </div>
            <div class="col-lg-2">
                {{ post.external_id }}
            </div>
            <div class="col-lg-2">
                {{ post.parsed_at }}
            </div>
            <div class="col-lg-2">
                {{ post.publication_date }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostPreview",
    props: {
        post: {
            required: true,
        }
    },
}
</script>

<style scoped>
.post-preview {
    background-color: #fff;
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
}
.post-preview a {
    color: #262525;
}
</style>
