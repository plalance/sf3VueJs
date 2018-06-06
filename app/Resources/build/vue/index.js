import Vue from 'vue';
import axios from "axios";
import VueAxios from 'vue-axios';
import VueLodash from 'vue-lodash';
import App from './index.vue';

window.Vue = Vue;

Vue.use(VueAxios, axios, VueLodash);

let app = new Vue({
    el: '#app',
    data: datas,
    render: h => h(App),
});