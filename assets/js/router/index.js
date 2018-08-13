import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

import Home from '../components/Home.vue'
import Notfound from '../components/Notfound.vue'
import About from '../components/About.vue'

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: Home
        },
        {
            path: '*',
            name: '404',
            component: Notfound
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        }
    ]
})
