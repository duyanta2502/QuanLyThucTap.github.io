import { createWebHistory,createRouter } from 'vue-router';
import Register from '../components/auth/Register.vue'
import Login from '../components/auth/Login.vue'
import Dashboard from '../components/admin/Dashboard.vue'
import ForgotPassword from '../components/auth/ForgotPassword.vue'
import ResetPassword from '../components/auth/ResetPassword.vue';
import Profile from '../components/user/Profile.vue';
import userIndex from '../components/user/indexUser.vue';
import indexLecturer from '../components/user/indexLecturer.vue'
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
    {
        path: '/admin/edit-profile',
        name: 'Profile', 
        component: Profile
    }, 
    {
        path:'/admin/user',
        name:'userIndex',
        component: userIndex,
    },
    {
        path:'/admin/lecturer',
        name:'indexLecturer',   
        component: indexLecturer,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
