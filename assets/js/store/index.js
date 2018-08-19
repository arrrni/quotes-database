import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import * as Cookies from 'js-cookie';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        userId: null
    },
    getters: {
        userId: state => {
            return state.userId
        }
    },
    mutations: {
        setUser(state, user) {
            state.userId = user
        }
    },
    plugins: [createPersistedState()]
});

export default store;