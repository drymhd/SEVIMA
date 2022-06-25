// import { VueRouter } from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'

// Pages
import Redirect from './pages/Redirect/Index.vue'
import Home from './pages/Home/Index.vue'
import Register from './pages/Register'
import Login from './pages/Login/Index.vue'
import Dashboard from './pages/Siswa/Dashboard/Index.vue'
import DashboardAdmin from './pages/Admin/Dashboard/Index.vue'
import KelasAdmin from './pages/Admin/Kelas/Index.vue'

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
            path: '/home',
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
        // Siswa ROUTES
        {
            path: '/dashboard-siswa',
            name: 'siswa',
            component: Dashboard,
        },

        //Admin ROUTES

        {
            path: '/dashboard-admin',
            name: 'admin',
            component: DashboardAdmin,
        },
        {
            path: '/kelas-admin',
            name: 'admin.kelas',
            component: KelasAdmin,
        },

    ]
})

export default (app) => {
    app.router = router;

    app.use(router);
}