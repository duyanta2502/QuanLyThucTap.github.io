
                    
<template>
    <div class="NavMenu">
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container-fluid">
          <!-- Logo -->
          <router-link to="/admin/dashboard" class="navbar-brand">
            Quản lý Sinh viên
          </router-link>
  
          <!-- Menu links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row gap-3">
            <li class="nav-item">
              <router-link to="/admin/dashboard" class="nav-link">Sinh viên</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/giangvien" class="nav-link">Giảng viên</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/khoathuctap" class="nav-link">Khóa thực tập</router-link>
            </li>
          </ul>
  
          <!-- Right section: user name & logout -->
          <div class="d-flex align-items-center">
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
    </div>
  </template>
  

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

<style>
    @import 'Dashboard.css';
</style>