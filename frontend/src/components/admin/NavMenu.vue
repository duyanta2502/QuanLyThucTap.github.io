<template>
        <div class = "NavMenu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
                    <router-link to ="/admin/dashboard" class="nav-link">
                        <a class="navbar-brand" href="#">Quản lý Sinh viên</a>
                    </router-link>
                    <div class="d-flex ms-auto">
                    <!-- User name display -->
                    <router-link to ="/admin/edit-profile" class="nav-link">
                        <span class="navbar-text mx-3">
                            Xin chào, {{ dataProfile.name }}
                        </span>
                    </router-link>
                    <button class="btn btn-danger" @click="logout">
                        Logout
                    </button>
                </div>
                </div>
            </nav>
        </div>   </template>

<script>
    import { 
        onMounted ,
        reactive,
    } from 'vue';
    import { useRouter } from 'vue-router';
    import api from '../../axios.js';
    import { useAuthStore } from '../../../stores/authStore';
    export  default {
        setup(){
            const router = useRouter();
            const authStore = useAuthStore();

            const dataProfile = reactive({
                name: '',
            });
            //  đăng xuất
            const logout = async() => {
                await api.get('/api/logout')
                    .then(response => { 
                        localStorage.removeItem('token');
                        authStore.logout();
                        router.push('/login');
                    })
                    .catch(error => {
                        console.error("api error: ", error);
                    })
            }
            onMounted(() => {
                dataProfile.name = authStore.user.name;
            });
            return {
                logout,
                dataProfile,
            }
        }
    }
</script>

