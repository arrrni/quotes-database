import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router/'
//import store from './store/'
//import BootstrapVue from 'bootstrap-vue'
//import VueProgressBar from 'vue-progressbar'
//import Toasted from 'vue-toasted';

import eventBus from './helpers/eventBus'

import App from './App'

//const progressBarOptions = {
//    color: '#3BE1FD',
//    failedColor: '#ff4b53',
//    thickness: '3px',
//    transition: {
//        speed: '0.5s',
//        opacity: '0.6s',
//        termination: 300
//    },
//    autoRevert: true,
//    location: 'top',
//    inverse: false
//}

Vue.config.productionTip = false;

// pusta instancja Vue co robi za transport między komponentami
Vue.prototype.$bus = eventBus

//Vue.use(BootstrapVue);
//Vue.use(VueProgressBar, progressBarOptions);
Vue.use(VueRouter);
//Vue.use(Toasted)

// bootstrap the demo
let application = new Vue({
    el: '#vueApp',
    router,
    // store,
    template: '<App/>',
    components: { App }
})
