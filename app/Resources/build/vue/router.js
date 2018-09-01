import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./Pages/Home.vue'),
        },
        {
            path: '/foo',
            name: 'foo',
            component: require('./Pages/Foo.vue'),
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: require('./Pages/Dashboard.vue'),
        },
    ]
});

global.router = router;

export default router