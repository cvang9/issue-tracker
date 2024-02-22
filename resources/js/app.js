import "./bootstrap";
import { createApp } from "vue";
import router from './router/router.js';

import App from "./components/App.vue";

const app = createApp({});

app.component('App', App );

app.use(router);

app.mount("#app");