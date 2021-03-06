require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css';

import Swal from 'sweetalert2'
import Toastr from 'toastr'

import _ from 'lodash';

import * as bootstrap from 'bootstrap';

window.Swal = Swal;
window.toastr = Toastr;

import Paginate from './components/Paginate';

import jQuery from 'jquery';
window.$ = jQuery;

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
    .component('paginate', Paginate)
    .use(http)
    .use(router)
    .use(routeAuth)
    .use(auth)
    .mount('#app');