import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

import Home from '../pages/Home.vue'
import Notfound from '../pages/Notfound.vue'
import About from '../pages/About.vue'
import ViewQuote from '../pages/ViewQuote.vue'
import AddQuote from '../pages/AddQuote.vue'

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
        },
        {
            path: '/q/:id',
            name: 'viewQuote',
            component: ViewQuote
        },
        {
            path: '/add',
            name: 'addQuote',
            component: AddQuote
        }
    ]
})
