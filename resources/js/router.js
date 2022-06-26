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
import MapelAdmin from './pages/Admin/Mapel/Index.vue'
import SiswaAdmin from './pages/Admin/Siswa/Index.vue'
import GuruAdmin from './pages/Admin/Guru/Index.vue'
import KelasMapelAdmin from './pages/Admin/KelasMapel/Index.vue'

import DashboardGuru from './pages/Guru/Dashboard/Index.vue'
import KelasGuru from './pages/Guru/Kelas/Index.vue'
import RuangGuru from './pages/Guru/RuangKelas/Index.vue'
import RoomGuru from './pages/Guru/Room/Index.vue'
import MateriGuru from './pages/Guru/Materi/Index.vue'

import DaftarKelasSiswa from './pages/Siswa/daftarkelas/Index.vue'
import MateriKelasSiswa from './pages/Siswa/Materi/Index.vue'
import MateriTugasSiswa from './pages/Siswa/MateriTugas/Index.vue'
// Routes
const router = createRouter({
    hasbang: false,
    history: createWebHistory(),
    routes: [{
            path: '/',
            name: 'redirect',
            component: Redirect,
            meta: {
                title: 'loading',
                auth: undefined
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false,
                title: 'register',
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
            meta: {
                title: 'siswa',
            }
        },

        {
            path: '/daftarkelas-siswa',
            name: 'siswa.daftarkelas',
            component: DaftarKelasSiswa,
            meta: {
                title: 'siswa-daftar-kelas',
            }
        },
        {
            path: '/materi-siswa/:id',
            name: 'siswa.materi',
            component: MateriKelasSiswa,
            meta: {
                title: 'siswa-materi',
            }
        },
        {
            path: '/materitugas-siswa/:id',
            name: 'siswa.materitugas',
            component: MateriTugasSiswa,
            meta: {
                title: 'siswa-materi-tugas',
            }
        },

        // Guru ROUTES
        {
            path: '/dashboard-guru',
            name: 'guru',
            component: DashboardGuru,
            meta: {
                title: 'guru',
            }
        },
        {
            path: '/daftarkelas-guru',
            name: 'guru.daftarkelas',
            component: KelasGuru,
            meta: {
                title: 'guru-kelas',
            }
        },
        {
            path: '/ruangkelas-guru',
            name: 'guru.ruangkelas',
            component: RuangGuru,
            meta: {
                title: 'guru-ruang-kelas',
            }
        },
        {
            path: '/materi-guru/:id',
            name: 'guru.materi',
            component: MateriGuru,
            meta: {
                title: 'guru-materi',
            }
        },
        {
            path: '/room-guru/:id',
            name: 'guru.room',
            component: RoomGuru,
            meta: {
                title: 'guru-ruang',
            }
        },

        //Admin ROUTES

        {
            path: '/dashboard-admin',
            name: 'admin',
            component: DashboardAdmin,
            meta: {
                title: 'admin',
            }
        },
        {
            path: '/kelas-admin',
            name: 'admin.kelas',
            component: KelasAdmin,
            meta: {
                title: 'admin-kelas',
            }
        },
        {
            path: '/mapel-admin',
            name: 'admin.mapel',
            component: MapelAdmin,
            meta: {
                title: 'admin-mapel',
            }
        },
        {
            path: '/siswa-admin',
            name: 'admin.siswa',
            component: SiswaAdmin,
            meta: {
                title: 'admin-siswa',
            }
        },
        {
            path: '/guru-admin',
            name: 'admin.guru',
            component: GuruAdmin,
            meta: {
                title: 'admin-guru',
            }
        },
        {
            path: '/kelasmapel-admin',
            name: 'admin.kelasmapel',
            component: KelasMapelAdmin,
            meta: {
                title: 'admin-kelas-mapel',
            }
        },
        {
            path: '/*',
            name: 'notfound',
            component: Redirect,
            meta: {
                title: 'loading',
            }
        },
        {
            path: '/404',
            name: 'notfound404',
            component: Redirect,
            meta: {
                title: 'loading',
            }
        },

    ]
});

router.beforeEach((to, from, next) => {
    var title = document.querySelector("meta[name='title']").getAttribute("content");
    document.title = to.meta.title;
    next()
});


export default (app) => {
    app.router = router;

    app.use(router);
}