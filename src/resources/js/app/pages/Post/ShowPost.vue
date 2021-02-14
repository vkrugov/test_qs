<template>
    <div class="container pt-5">
        <div>
            <router-link :to="{name: 'home'}">Back to all posts</router-link>
        </div>
        <h2>
            {{ post.title }}
        </h2>
        <hr>
        <p>
            <strong>
                Id:
            </strong>
            {{ post.id }}
        </p>
        <p>
            <strong>
                Habr Id:
            </strong>
            {{ post.external_id }}
        </p>
        <p>
            <strong>
                Date of publication:
            </strong>
            {{ post.publication_date }}
        </p>
        <p>
            <strong>
                Parsed At:
            </strong>
            {{ post.parsed_at }}
        </p>
        <hr>
        <p>
            <strong>
                Description:
            </strong>
        </p>
        <div v-html="post.body" class="overflow-auto post-desc">
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex";
import {GET_POST} from "../../../store/actions/post.actions";

export default {
    name: "ShowPost",
    computed: mapState({
        post: (state) => state.post.selectedPost,
    }),
    methods: {
        loadPost() {
            let id = this.$route.params.post

            if (id) {
                this.$store.dispatch(GET_POST, {id: id}).then(() => {
                }).catch(() => {
                    this.$router.push({name: 'notfound'});
                });
            }
        },
    },
    created() {
        this.loadPost();
    }
}
</script>

<style scoped>
.post-desc {
    background-color: #f3f3f3;
    padding: 1px;
}
</style>
