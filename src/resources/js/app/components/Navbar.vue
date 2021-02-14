<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="dark">
            <router-link class="nav-link site-logo" :to="{name: 'home'}"> Home</router-link>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>

                </b-navbar-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
export default {
    name: "Navbar"
}
</script>

<style scoped>
.site-logo {
    color: aliceblue;
}
</style>
