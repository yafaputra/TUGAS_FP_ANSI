import { createRouter, createWebHistory } from 'vue-router'
import Hompage from '../views/Hompage.vue'
import Event from '../views/Event.vue'
import Sparring from '../views/Sparring.vue'
import Mendaftar_Sparring from '../views/Sparring/Mendaftar_Sparring.vue'
import Login from '../views/Daftar/Login.vue'
import Register from '../views/Daftar/Register.vue'
import Venue from '../views/Venue/Venue.vue'
import Mendaftar_Lapangan from '../views/Venue/Mendaftar_Lapangan.vue'
import Profil_Penguna from '@/views/Profil/Profil_Penguna.vue'
import Dashboard_Penguna from '@/views/Dashbord/Dashboard_Penguna.vue'
import Dashboard_Sparring from '@/views/Dashbord/Dashboard_Sparring.vue'

const routes = [
  { path: '/', redirect: '/Hompage' },
  { path: '/Hompage', component: Hompage },
  { path: '/venue', component: Venue },
  { path: '/event', component: Event },
  { path: '/sparring', component: Sparring },
  { path: '/Login', component: Login },
  { path: '/Register', component: Register },
  { path: '/Mendaftar_Sparring', component: Mendaftar_Sparring},
  { path: '/Mendaftar_Lapangan', component: Mendaftar_Lapangan },
  { path: '/Profil_Penguna', component: Profil_Penguna },
  { path: '/Dashboard_Penguna', component: Dashboard_Penguna },
  { path: '/Dashboard_Sparring', component: Dashboard_Sparring },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
