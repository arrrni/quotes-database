import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router/'
import Buefy from 'buefy'
import VueMoment from 'vue-moment'

import eventBus from './helpers/eventBus'

import App from './App.vue'

Vue.config.productionTip = false;

// pusta instancja Vue co robi za transport między komponentami
Vue.prototype.$bus = eventBus

Vue.use(VueRouter);
Vue.use(Buefy);
Vue.use(VueMoment);

// app init
let application = new Vue({
    el: '#vueApp',
    router,
    // store,
    template: '<App/>',
    components: { App }
})
