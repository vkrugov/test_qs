import VueRouter from "vue-router";
import Home from "./app/pages/Home";
import AllPosts from "./app/pages/Post/AllPosts";
import ShowPost from "./app/pages/Post/ShowPost";
import NotFound from "./app/components/NotFound";

const router =  new VueRouter ({
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/posts',
            component: AllPosts,
            name: 'posts'
        },
        {
            path: '/post/:post',
            component: ShowPost,
            name: 'showPost'
        },
        {
            path: '/*',
            component: NotFound,
            name: 'notfound',
        }
    ],
    mode: 'history'
});

export default router
