require("./bootstrap");

window.Vue = require("vue");
         
import Vue from "vue";
import router from "./router";
import store from './index'


Vue.config.productionTip = false

Vue.component('my-app', require('./components/app.vue').default);


const app = new Vue({
    el: "#app",
    router: router,
    store
});