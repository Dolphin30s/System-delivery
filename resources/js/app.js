/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from "vue-axios";
import VueRouter from "vue-router"
import Vuesax from 'vuesax'
import axios from './axios'
import i18n from './i18n';

import auth from './auth'
import router from './router'
import store from './store/store'
import App from './App.vue'
import { VueHammer } from 'vue2-hammer'
import VeeValidate from 'vee-validate'
import * as VueGoogleMaps from 'vue2-google-maps'


Vue.router = router
Vue.use(Vuesax)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)
Vue.use(VueHammer)
Vue.use(VeeValidate)
Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_API_KEY,
        libraries: 'places'
    }
})

import './bootstrap.js';
import './globalComponents.js'

// PrismJS
import 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'

window.Vue = require('vue').default;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    router,
    i18n: i18n,
    render: h => h(App),
}).$mount('#app');
