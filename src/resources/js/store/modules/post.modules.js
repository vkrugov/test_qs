import {
    GET_POST,
    GET_POST_SUCCESS,
    GET_POSTS,
    GET_POSTS_ERROR,
    GET_POSTS_SUCCESS,
} from "../actions/post.actions";
import api from "../../config";

const state = {
    posts: [],
    meta: [],
    selectedPost: {},
};

const actions = {
    [GET_POSTS]: ({commit}, payload) => {
        return new Promise((resolve, reject) => {
            commit(GET_POSTS);
            let url = '/posts';
            let strParams = '?'
            let stringify = require('qs-stringify')
            strParams += stringify(payload);
            api.get(url + strParams)
                .then(({data}) => {
                    commit(GET_POSTS_SUCCESS, data);
                    resolve();
                })
                .catch(err => {
                    commit(GET_POSTS_ERROR);
                    reject(err);
                })
        });
    },
    [GET_POST]: ({commit}, payload) => {
        return new Promise((resolve, reject) => {
            commit(GET_POSTS);
            api.get('/posts/' + payload.id)
                .then(({data}) => {
                    commit(GET_POST_SUCCESS, data);
                    resolve();
                })
                .catch(err => {
                    reject(err);
                })
        });
    },
}

const mutations = {
    [GET_POSTS]: (state) => {
        state.status = "loading";
    },
    [GET_POSTS_SUCCESS]: (state, data) => {
        state.status = "success";
        state.posts = data.posts;
        state.meta = data.meta;
    },
    [GET_POSTS_ERROR]: (state) => {
        state.status = "";
    },
    [GET_POST_SUCCESS]: (state, data) => {
        state.selectedPost = data.post;
    },
}

export default {
    state,
    actions,
    mutations
}
