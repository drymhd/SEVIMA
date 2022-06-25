// import { VueRouter } from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'

// Pages
import Redirect from './pages/Redirect/Index.vue'
import Home from './pages/Home/Index.vue'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/Siswa/Dashboard/Index.vue'

// Routes
const router = createRouter({
    hasbang: false,
    history: createWebHistory(),
    routes: [{
            path: '/',
            name: 'redirect',
            component: Redirect,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                auth: false
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
        // Siswa ROUTES
        {
            path: '/dashboard-siswa',
            name: 'siswa',
            component: Dashboard,
        },
    ]
})

export default (app) => {
    app.router = router;

    app.use(router);
}