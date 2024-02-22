import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/LoginPage.vue';
import LoginAs from '../pages/LoginAsPage.vue'

export default createRouter({

    history: createWebHistory(),
    routes: [
        { path: '/', component: LoginAs },
        { path: '/login', component: Login }
    ]
});

