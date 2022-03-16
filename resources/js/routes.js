// FRONTEND ---------
import Home from './components/frontend/Home.vue';
import Login from './components/frontend/Login.vue';
import Cart from './components/frontend/Cart.vue';

// ------------------

// BACKEND ----------
import Dashboard from './components/backend/Dashboard.vue';
import NewCar from './components/backend/AddCars.vue';
import Brands from './components/backend/Brands.vue';
// ------------------


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },    
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/admin/',
        component: Dashboard
    },
    {
        name: 'newcar',
        path: '/admin/cars',
        component: NewCar
    },
    {
        name: 'brands',
        path: '/admin/brands',
        component: Brands
    },
    {
        name: 'cart',
        path: '/cart',
        component: Cart
    },
];