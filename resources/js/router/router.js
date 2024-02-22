import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Auth/LoginPage.vue';
import LoginAs from '../pages/Auth/LoginAsPage.vue';
import Signup from '../pages/Auth/SignupPage.vue';

export default createRouter({

    history: createWebHistory(),
    routes: [
        { path: '/', component: LoginAs },
        { path: '/login', component: Login },
        { path: '/user-signup', component: Signup }
    ]
});

