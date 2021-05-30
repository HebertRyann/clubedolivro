import {  createRouter, createWebHistory } from 'vue-router';
import SignIn from '../views/SignIn';
import SignUp from '../views/SignUp';
import Dashboard from '../views/Dashboard';
import Reservation from '../views/Reservation';

const routes = [
  { name: 'SignIn', path: '/', component: SignIn },
  { name: 'SignUp', path: '/signup', component: SignUp},
  { name: 'Dashboard', path: '/dashboard/:user', component: Dashboard},
  { name: 'Dashboard', path: '/dashboard', component: Dashboard},
  { name: 'Reservation', path: '/reservation/:id/:user', component: Reservation},
  { name: 'Reservation', path: '/reservation', component: Reservation},
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;