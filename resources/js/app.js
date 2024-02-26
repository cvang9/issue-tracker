import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import '../css/app.css';


import 'jsvectormap/dist/css/jsvectormap.min.css'
import 'flatpickr/dist/flatpickr.min.css'
import VueApexCharts from 'vue3-apexcharts'

import router from './router/router.js';
import App from "./components/App.vue";

const app = createApp({});
const pinia = createPinia();

app.component('App', App );

app.use(router);
app.use(pinia);
app.use(VueApexCharts)

app.mount("#app");