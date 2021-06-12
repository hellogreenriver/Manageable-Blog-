require("./bootstrap");

window.Vue = require("vue");
         
import Vue from "vue";
import router from "./router";
import store from './index'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.component('my-app', require('./components/app.vue').default);


const app = new Vue({
    el: "#app2",
    router: router,
    store
});