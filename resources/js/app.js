import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";

import router from './router/router.js';

import App from "./components/App.vue";

const app = createApp({});
const pinia = createPinia();

app.component('App', App );

app.use(router);
app.use(pinia);

app.mount("#app");