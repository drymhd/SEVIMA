// import { VueRouter } from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'

// Pages
import Home from './pages/Home/Index.vue'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/User/Home'

// Routes
const router = createRouter({
    hasbang: false,
    history: createWebHistory(),
    routes: [{
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        // USER ROUTES
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
        },
    ]
})

export default (app) => {
    app.router = router;

    app.use(router);
}