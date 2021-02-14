<template>
    <div id="main-app">
        <navbar></navbar>
        <div class="site-content">
            <router-view></router-view>
        </div>
        <app-footer></app-footer>
    </div>
</template>
<script>
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";

export default {
    name: "App",
    components: {
        Navbar,
        appFooter: Footer,
    },
    methods: {
    },
}
</script>

<style scoped>
.site-content {
    padding-bottom: 50px;
    min-height: 1000px;
    background-color: #fafafa;
}
</style>
