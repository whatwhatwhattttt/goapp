import Vue from 'vue';
import Vuex from 'vuex';

import app from './modules/app';
import user from './modules/user';
import AuthUser from './modules/auth-user';
import Login from './modules/login';
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        //
    },
    mutations: {
        //
    },
    actions: {

    },
    modules: {
        app,
        user,
        AuthUser,
        Login
    }
 });
//
// export default new Vuex.Store({
//     modules:{
//         AuthUser,
//         Login
//     },
//     strict:true
// });
export  default  store;
