import { createRouter, createWebHistory } from "vue-router";
import Login from '../pages/Auth/LoginPage.vue';
import LoginAs from '../pages/Auth/LoginAsPage.vue';
import Signup from '../pages/Auth/SignupPage.vue';
import Resolver from '../components/Resolver/MainPage.vue';
import ResolverProfile from '../components/Resolver/ResolverProfile.vue';

import AdminDashboard from '@/views/Dashboard/AdminDashboard.vue'
import SettingsView from '@/views/Pages/SettingsView.vue'
import CreateDepartment from '@/views/Pages/CreateDepartment.vue'
import TablesView from '@/views/TablesView.vue'
import Chat from '../components/Chat.vue';

import Tickets from '../components/User/Tickets.vue';
import TicketDetail from '../components/User/TicketDetail.vue';
import { getCookie } from "../helper/CookieHelper.js"; 

function isAdmin() {
    if( getCookie('role') === 'admin' ) {
        return true;
    }
    return false;
}

function isResolver() {
    if( getCookie('role') === 'resolver' ) {
        return true;
    }
    return false;
}

function isUser() {
    if( getCookie('role') === 'user' ) {
        return true;
    }
    return false;
}


export default createRouter({

    history: createWebHistory(),
    routes: [
        { 
            path: '/',
            component: LoginAs,
            beforeEnter: ( to, from, next ) => {

                if(  getCookie('role') )
                {
                    if( isAdmin() ) 
                    {
                        next('/admin');
                    }
                    else if( isResolver() ) 
                    {
                        const resolverId = getCookie('resolverId');
                        next('/resolver/' + resolverId);
                    }
                    else if( isUser() ) 
                    {
                        const userId = getCookie('resolverId');
                        next('/users/' + userId );
                    }
                }
                else {
                    next();
                }
            }
        },
        {
            path: '/login',
            component: Login,
            beforeEnter: ( to, from, next ) => {

                if(  getCookie('role') )
                {
                    if( isAdmin() ) 
                    {
                        next('/admin');
                    }
                    else if( isResolver() ) 
                    {
                        const resolverId = getCookie('resolverId');
                        next('/resolver/' + resolverId);
                    }
                    else if( isUser() ) 
                    {
                        const userId = getCookie('resolverId');
                        next('/users/' + userId );
                    }
                }
                else {
                    next();
                }
            }
        },
        {
            path: '/user-signup',
            component: Signup,
            beforeEnter: ( to, from, next ) => {

                if(  getCookie('role') )
                {
                    if( isAdmin() ) 
                    {
                        next('/admin');
                    }
                    else if( isResolver() ) 
                    {
                        const resolverId = getCookie('resolverId');
                        next('/resolver/' + resolverId);
                    }
                    else if( isUser() ) 
                    {
                        const userId = getCookie('resolverId');
                        next('/users/' + userId );
                    }
                }
                else {
                    next();
                }
            }
        },
        {
            path: '/resolver/:id',
            component: Resolver,
            beforeEnter: ( to, from, next ) => {
                if(isResolver()) {
                    next();
                }
                else {
                    next('/error')
                }
            }
        },
        {
            path: '/resolver-profile/:id',
            component: ResolverProfile,
            beforeEnter: ( to, from, next ) => {
                if(isResolver()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/users/:id',
            component: Tickets,
            beforeEnter: ( to, from, next ) => {
                if(isUser()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/TicketDetails/:id',
            component: TicketDetail, name: 'TicketDetail',
            beforeEnter: ( to, from, next ) => {
                if(isUser()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/admin',
            name: 'adminDashboard',
            component: AdminDashboard,
            meta: {
              title: 'Admin Dashboard'
            },
            beforeEnter: ( to, from, next ) => {
                if(isAdmin()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/tables',
            name: 'tables',
            component: TablesView,
            beforeEnter: ( to, from, next ) => {
                if(isAdmin()) {
                    next();
                }
                else {
                    next('/error')
                }

            },
            meta: {
              title: 'Tables'
            }
        },
        {
            path: '/create/resolver',
            name: 'settings',
            component: SettingsView,
            meta: {
              title: 'Create Resolver'
            },
            beforeEnter: ( to, from, next ) => {
                if(isAdmin()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/create/department',
            name: 'departmentCreate',
            component: CreateDepartment,
            meta: {
              title: 'Create Department'
            },
            beforeEnter: ( to, from, next ) => {
                if(isAdmin()) {
                    next();
                }
                else {
                    next('/error')
                }

            }
        },
        {
            path: '/chat',
            name: 'queryChat',
            component: Chat
        }

    ]
});

