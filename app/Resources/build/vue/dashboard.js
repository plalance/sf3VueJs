import Vue from 'vue';
import axios from "axios";
import VueAxios from 'vue-axios';
import VueLodash from 'vue-lodash';
import Dashboard from './Pages/Dashboard';
import VueQuillEditor from 'vue-quill-editor';

window.Vue = Vue;

Vue.use(VueAxios, axios, VueLodash, VueQuillEditor);

let app = new Vue({
    el: '#app',
    data: datas,
    render: h => h(Dashboard),
});