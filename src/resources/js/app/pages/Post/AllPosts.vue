<template>
    <div>
        <h1>
            Posts
        </h1>
        <div class="p-2 row">
            <div class="col-lg-8">
                <b-input @input="searchPosts" v-model="filter.title" placeholder="Just input to search by title"></b-input>
            </div>
            <div class="col-lg-4 text-right">
                <b-form-select
                    @change="getWithSort"
                    v-model="sort"
                    :options="options"
                    class="pull-right"
                    value-field="item"
                    text-field="name"
                    disabled-field="notEnabled"
                ></b-form-select>
            </div>
        </div>
        <div v-if="posts.length" class="post-table">
            <div class="row pt-2 pb-2">
                <div class="col-lg-6 text-left pt-1 pb-1">
                    <strong>Title</strong>
                </div>
                <div class="col-lg-2">
                    <strong>External Id</strong>
                </div>
                <div class="col-lg-2">
                    <strong>Parsed Date</strong>
                </div>
                <div class="col-lg-2">
                    <strong>Date of Publication</strong>
                </div>
            </div>
            <div v-for="post in posts" class="mb-2">
                <post-preview
                    :post="post"
                ></post-preview>
            </div>
        </div>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center justify-content-lg-center">
                    <li v-if="meta.current_page > 1" meta.current_page class="cursor-pointer"><span
                        class="page-link" @click="getByPage(meta.current_page - 1)"
                        aria-label="Previous"><span aria-hidden="true">«</span></span></li>
                    <li v-for="key in meta.last_page"
                        v-show="key >= meta.current_page - 4 && key <= meta.current_page + 4"
                        class="cursor-pointer" :class="key === meta.current_page ? 'active-pagination' : 'pagination'">
                        <span class="page-link" @click="getByPage(key)"> {{ key }} </span>
                    </li>
                    <li v-if="meta.current_page < meta.last_page" class="cursor-pointer"><span
                        class="page-link" @click="getByPage(meta.current_page + 1)"
                        aria-label="Next"><span
                        aria-hidden="true">»</span></span></li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>

import {GET_POSTS} from "../../../store/actions/post.actions";
import {mapState} from "vuex";
import PostPreview from "./PostPreview";

export default {
    name: "AllPosts",
    computed: mapState({
        posts: (state) => state.post.posts,
        meta: (state) => state.post.meta,
    }),
    components: {
        PostPreview,
    },
    data() {
        return {
            filter : {
                title: null,
            },
            sort: '-publication_date',
            options: [
                { item: '-publication_date', name: 'From Newest'},
                { item: 'publication_date', name: 'From Oldest' }
            ]
        }
    },
    methods: {
        getPosts() {
            this.$store.dispatch(GET_POSTS, {})
        },
        getWithSort(event) {
            this.$store.dispatch(GET_POSTS, {
                sort: this.sort,
                filter: this.filter,
            })
        },
        getByPage(page) {
            this.$store.dispatch(GET_POSTS, {
                sort: this.sort,
                filter: this.filter,
                page: page
            })
        },
        searchPosts()
        {
            this.$store.dispatch(GET_POSTS, {
                filter: this.filter,
                sort: this.sort
            })
        }
    },
    created() {
        this.getPosts();
    }
}
</script>

<style scoped>
.post-table {

}
.cursor-pointer {
    cursor: pointer;
}

.pagination span{
    color: #2c3e50;
}
.active-pagination span {
    background-color: #2c3e50;
    color: #edf2f7;
}
</style>
