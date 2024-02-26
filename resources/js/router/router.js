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

import Tickets from '../components/User/Tickets.vue';
import TicketDetail from '../components/User/TicketDetail.vue';

export default createRouter({

    history: createWebHistory(),
    routes: [
        { path: '/', component: LoginAs },
        { path: '/login', component: Login },
        { path: '/user-signup', component: Signup },
        { path: '/resolver/:id', component: Resolver },
        { path: '/resolver-profile/:id', component: ResolverProfile },
        { path: '/tickets', component: Tickets },
        { path: '/TicketDetails/:id', component: TicketDetail, name: 'TicketDetail' },
        {
            path: '/admin',
            name: 'adminDashboard',
            component: AdminDashboard,
            meta: {
              title: 'Admin Dashboard'
            }
          },
          {
            path: '/tables',
            name: 'tables',
            component: TablesView,
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
            }
          },
          {
            path: '/create/department',
            name: 'departmentCreate',
            component: CreateDepartment,
            meta: {
              title: 'Create Department'
            }
          },

    ]
});

