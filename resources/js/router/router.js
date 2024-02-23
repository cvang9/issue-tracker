import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Auth/LoginPage.vue';
import LoginAs from '../pages/Auth/LoginAsPage.vue';
import Signup from '../pages/Auth/SignupPage.vue';
import Resolver from '../components/Resolver/MainPage.vue';
import ResolverProfile from '../components/Resolver/ResolverProfile.vue';
import Tickets from '../components/User/Tickets.vue'

export default createRouter({

    history: createWebHistory(),
    routes: [
        { path: '/', component: LoginAs },
        { path: '/login', component: Login },
        { path: '/user-signup', component: Signup },
        { path: '/resolver', component: Resolver },
        { path: '/resolver-profile', component: ResolverProfile },
        { path: '/tickets', component: Tickets }
    ]
});

