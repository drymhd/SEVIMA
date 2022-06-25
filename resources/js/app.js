require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css';

import 'es6-promise'
window.jQuery = require('jquery');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import http from './http';
import auth from './auth.js';
import routeAuth from './routeAuth.js';

import { Tooltip, Toast, Popover, Modal } from 'bootstrap';

const app = createApp(App);



app
    .use(http)
    .use(router)
    .use(routeAuth)
    .use(auth)
    .mount('#app');