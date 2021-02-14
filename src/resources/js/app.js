require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from "./router";
import toastr from "toastr";
import App from "./app/App";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(toastr)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router
});
