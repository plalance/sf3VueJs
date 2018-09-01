import Vue from 'vue';

import router from './router'

import axios from "axios";
import VueAxios from 'vue-axios';
import VueLodash from 'vue-lodash';
import VueQuillEditor from 'vue-quill-editor';

Vue.use(VueAxios, axios, VueLodash, VueQuillEditor);

window.Vue = Vue;

new Vue({
    el: '#app',
    router: router,
    render: h => h(require('./App.vue'))
});