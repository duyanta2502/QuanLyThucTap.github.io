import { createWebHistory,createRouter } from 'vue-router';
import Register from '../components/auth/Register.vue'
import Login from '../components/auth/Login.vue'
import Dashboard from '../components/admin/Dashboard.vue'
import ForgotPassword from '../components/auth/ForgotPassword.vue'
import ResetPassword from '../components/auth/ResetPassword.vue';

const routes = [
    {  
        path: '/register', 
        name: 'Register',
        component: Register
    },
    {
        path: '/login', 
        name: 'Login',
        component: Login
    },
    {
        path: '/admin/dashboard', 
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/forgot-password',
        name: 'ForgotPassword', 
        component: ForgotPassword
    },
    {
        path: '/reset-password/:token',
        name: 'ResetPassword', 
        component: ResetPassword
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;