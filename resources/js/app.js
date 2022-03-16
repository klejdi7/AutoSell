// window.Vue = require('vue');
require('./bootstrap');

import Vue from 'vue';
import vuetify from './plugins/vuetify.js';
// import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);


const router = new VueRouter({
    mode: 'history',
    routes: routes
});

Vue.component('cart-modal', require('./components/utils/CartModal.vue').default);
Vue.component('user-modal', require('./components/utils/UserModal.vue').default);
Vue.component('app-interface', require('./App.vue').default);
Vue.component('csrf-token', require('./components/utils/CsrfToken.vue').default);
Vue.component('snack-bar', require('./components/utils/SnackBar.vue').default);
Vue.component('car-modal', require('./components/utils/CarModal.vue').default);
 
/**
 * 
 */
//  window.App = JSON.parse(atob(window.App));
const app = new Vue({
    el: '#app',
    router: router,
    vuetify,

    data() {

        return {

			drawer: false,

            // User Data ------
            isLoggedin: false,

			user: [],
            // ----------------

            // SnackBar Data --
            snackbar: false,
            snackColor: null,
            snackMsg: null,
            // ----------------

            // Cart Data ------
            cartItems: 0,
            cart: {},
            // ----------------

        }

    },
	watch: {
    },
	
	beforeMount() {
        this.getUser();  
        this.getCart();
    },

	methods: {

    getUser()
    {
            this.axios .get('/data/user').then(response => {
                this.user = response.data;
                this.isLoggedin = true;
            })
            .catch(e => {
                this.isLoggedin = e.response.data.logged_in;
            }); 
    },

    getCart()
	{

		this.axios.get(`/cart/checkCart`).then(response => {

        this.cartItems = response.data.count;
        this.cart = response.data.cart;
    })

		.catch(e => {
		
			this.errors = e.response;
        
		});

	},

    },
});

