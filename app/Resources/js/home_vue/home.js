import Vue from 'vue';
import App from './home.vue';
import axios from "axios";
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);

let app = new Vue({
    el: '#app',
    data: data,
    render: h => h(App),
});