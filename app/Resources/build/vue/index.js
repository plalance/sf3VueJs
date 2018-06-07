import Vue from 'vue';
import axios from "axios";
import VueAxios from 'vue-axios';
import VueLodash from 'vue-lodash';
import App from './index.vue';
import VueQuillEditor from 'vue-quill-editor';
import $ from 'jquery';

window.Vue = Vue;
window.$ = $;

Vue.use(VueAxios, axios, VueLodash, VueQuillEditor);

let app = new Vue({
    el: '#app',
    data: datas,
    render: h => h(App),
});