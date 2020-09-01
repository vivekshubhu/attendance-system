/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//router
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//components

import Login from './components/Login.vue';
import Admin from './components/Admin.vue';

const routes = [
    {
        path: '/login',
        component:require('./components/Login.vue').default
    },
    {
        path: '/admin',
        component: require('./components/Admin.vue').default,
        //  children: [{
        //     path:'project_gallary/:projectId',
        //     name:'MyComponent',
        //     component:require('./components/ProjectGallary.vue').default,
        //     props:true,
        // }]
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.component('Navbar', require('./components/Navbar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
