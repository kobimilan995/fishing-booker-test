import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import axios from 'axios'
import moment from 'moment'
import Notifications from 'vue-notification'
window.moment = moment;
import 'bootstrap/dist/css/bootstrap.min.css';
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Notifications);
Vue.config.productionTip = false


/*
ROUTER
*/
import routes from './routes'

const router = new VueRouter({
    routes
})


router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('auth-token') == null) {
            next({
                path: '/login'
            })
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if(localStorage.getItem('auth-token') == null){
            next()
        }
        else{
            next('/')
        }
    } else if(to.matched.some(record => record.meta.admin)) {
        let user = JSON.parse(localStorage.getItem('auth-user'));
        if(user.role_name != 'Admin') {
            next({
                name: 'home'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})



/*
VUEX
*/
import storeObject from './vuex/index';
const store = new Vuex.Store(storeObject);


/*
AXIOS
*/
window.axios = axios;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
