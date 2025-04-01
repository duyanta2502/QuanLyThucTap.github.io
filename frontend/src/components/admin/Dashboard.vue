<template>
    <div class="container mt-5">
        <!-- Navbar -->
        <NavMenu></NavMenu>
        <!-- indecUser -->
        <indexUser></indexUser>
    </div>
</template>

<script>
    import { 
        ref, 
        onMounted 
    } from 'vue';
    
    import NavMenu from './NavMenu.vue';
    import indexUser from '../user/indexUser.vue';
    import api from '../../axios.js';
    export  default {
        components: {
            indexUser,
            NavMenu
        },
        // setup(){
        //     const countStudents = ref(0);
            
        //     // const fetchStudentsCount = async() => {
        //     //     await api.get('/api/count-user')
        //     //         .then(response => {
        //     //             countStudents.value = response.data;
        //     //         })
        //     //         .catch(error => {
        //     //             console.error("api error: ", error);
        //     //         })
        //     // }

            
        //     onMounted(() => {
        //         fetchStudentsCount(); 
        //     });

        //     return {
        //         countStudents,
        //     }
        // }
    }
</script>

