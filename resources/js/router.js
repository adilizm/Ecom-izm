import { createRouter, createWebHistory } from 'vue-router'

import Home from '../js/views/Home.vue';
import About from '../js/views/About';
import Allprodects from '../js/views/Allprodects';
import oneProduct from '../js/views/oneProduct';
import cart from '../js/views/cart';

 let routes= [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/all-products',
        name: 'all-products',
        component: Allprodects
    },
    {
        path: '/product/:slug',
        name: 'one-product',
        component: oneProduct,
        props:true
    },
    {
        path: '/cart',
        name: 'cart',
        component: cart
    }
]
const router = createRouter({
    history: createWebHistory('#'),
    routes
  })

export default router;