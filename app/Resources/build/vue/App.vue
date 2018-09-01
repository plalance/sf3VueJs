<template>
    <div id="app">
        <h2>App</h2>
        <ul>
            <li v-for="route in routes">
                <router-link :to="route.path">{{ route.name }}</router-link>
            </li>
        </ul>
        <div class="app__page">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data: function () {
            return {
                routes: router.options.routes
            }
        },
        created() {
        },
        beforeMount() {
        },
        mounted() {
        },
        computed: {},
    };
</script>