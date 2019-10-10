
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
 import Vue from 'vue';
 import VueRouter from 'vue-router';
  Vue.use(VueRouter);

 
 const routes = [
 
     {path: '/login', component:Login},
     {path: '/Register', component:Register},
     {path: '/home', component:Home}
 ]

 const router = new VueRouter({
     routes,
 })
//Vue.component('example-component', require('./components/ExampleComponent.vue'));
import Myheader from './components/Myheader.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Home from './components/Home.vue';
import Update from './components/Update.vue';

const app = new Vue({
    el: '#app',
    components:{
    Myheader,
    Login,
    Register,
    Home,
    Update
    },
    router
});
